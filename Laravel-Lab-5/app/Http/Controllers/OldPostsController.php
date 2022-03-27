<?php
namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Post ;
use App\Models\User ;
use Carbon\Carbon ;

class OldPostsController extends Controller
{

    function index (){
        $posts = Post::paginate(2);
        return view("posts",["posts"=>$posts]);
    }

    function store(StorePostRequest $request){
        $request_data = $request->validated();
        $post = new Post();
        $post->title =$request_data["title"];
        $post->discription =$request_data["discription"];
        $post->user_id = $request_data["user"];
        $post->save();
        return to_route("posts.index");
    }

    function view($id){
        $post = Post::findOrFail($id);
        $date=Carbon::parse($post['created_at'])->format("d-m-y");
        return view("view",["post"=>$post],["date"=>$date]);
    }

    function add(){
        $users=User::all();
        return view("add",["users"=>$users]);
    }
    
    function edit($id){
        $users=User::all();
        $post = Post::findOrFail($id);
        return view("update",["post"=>$post,"users"=>$users]);
    }

    function update($id){
        $updatedpost = Post::findOrFail($id);
        $updatedpost->title = request("title");
        $updatedpost->discription = request("discription");
        $updatedpost->user_id = request("user");
        $updatedpost->save();
        return to_route("posts.index");
    }

    function destroy($id){
        Post::findOrFail($id)->delete();
        return to_route("posts.index");
    }
}