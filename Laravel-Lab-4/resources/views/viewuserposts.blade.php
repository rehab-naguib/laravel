@extends('layouts/app')
@section('title')
    View user posts
@endsection
@section('topcontent')
<table class="table table-dark text-white">
  <tbody>
      <tr>
        <th scope="col">id</th>
        <th scope="col">Title</th>
        <th scope="col">Discription</th>
        <th scope="col">Day</th>
      </tr>
       @foreach($posts as $post)
      <tr>
        <td> {{ $post->id }} </td>
        <td> {{ $post->title }} </td>
        <td> {{ $post->discription }} </td>
        <td> {{ $post->created_at->format("d-m-y") }} </td>
        {{-- <td> <a href="{{route("posts.view",$post->id)}}" class="btn btn-info">View</a> </td>
        <td> <a href="{{route("posts.edit",$post->id)}}" class="btn btn-warning">Update</a> </td>
        <td>
        <form action={{ route('posts.destroy', [$post['id']]) }} method="POST" class="d-inline">
            @csrf
            @method("delete")
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item')">Delete</button>
          </form>
        </td> --}}
      </tr>
      @endforeach 
  </tbody>
</table>
@endsection