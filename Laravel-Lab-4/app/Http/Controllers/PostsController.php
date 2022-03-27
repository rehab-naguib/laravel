<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Jobs\PruneOldPostsJob;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Post ;
use App\Models\User ;
use Carbon\Carbon ;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $posts = Post::paginate(20);
        $end_old_posts = Post::all();
        dispatch(new PruneOldPostsJob($end_old_posts));
        return view("posts",["posts"=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::all();
        return view("add",["users"=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $request_data = $request->validated();
        //increase user number of posts
        $user = User::findOrFail($request->user);
        $numberOfPosts = $user->numberOfPosts + 1;
        // dd($numberOfPosts);
        $user->numberOfPosts = $numberOfPosts;
        $user->save();
        // dump(Auth::user()->id);
        $request_data["user"] = Auth::user()->id;
        $post = new Post();
        $post->title = $request_data["title"];
        $post->slug = SlugService::createSlug(Post::class, 'slug', $request_data["title"]);
        $post->discription =$request_data["discription"];
        $post->user_id = $request_data["user"];
        $post->save();
        return to_route("posts.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $date=Carbon::parse($post['created_at'])->format("d-m-y");
        return view("view",["post"=>$post],["date"=>$date]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users=User::all();
        $post = Post::findOrFail($id);
        if($post->user_id != Auth::user()->id){
            return abort(401);
        }else{
            return view("update",["post"=>$post,"users"=>$users]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request,$id)
    {
        $validated = $request->validated();
        $updatedpost = Post::findOrFail($id);
        $this->authorize("owns",$updatedpost);
        $updatedpost->title = request("title");
        $updatedpost->slug = SlugService::createSlug(Post::class, 'slug', request("title"));
        $updatedpost->discription = request("discription");
        $updatedpost->user_id = Auth::user()->id;
        $updatedpost->save();
        return to_route("posts.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if($post->user_id != Auth::user()->id){
            return abort(401);
        }else{
            $this->authorize("owns",$post);
            $user = User::findOrFail($post->user_id);
            $numberOfPosts = $user->numberOfPosts - 1;
            // dd($numberOfPosts);
            $user->numberOfPosts = $numberOfPosts;
            $user->save();
            $post->delete();
            return to_route("posts.index");
        }
    }
}
