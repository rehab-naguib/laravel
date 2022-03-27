@extends('layouts/app')
@section('title')
    view post
@endsection
@section('topcontent')
<table class="table table-dark text-white">
    <tbody>
      <tr>
        <th scope="col">id</th>
        <th scope="col">Title</th>
        <th scope="col">Created By</th>
        <th scope="col">More posts by author</th>
        <th scope="col">Discription</th>
        <th scope="col">Slug</th>
        <th scope="col">Day</th>
      </tr>    
      <tr>
        <td> {{ $post->id }} </td>
        <td> {{ $post->title }} </td>
        <td> {{ $post->user->name }} </td>
        <td> <a href="{{route("user.posts",$post->user_id)}}" class="btn btn-info">View</a> </td>
        <td> {{ $post->discription }} </td>
        <td> {{ $post->slug }} </td>
        <td> {{ $date }} </td>
      </tr>
  </tbody>
</table>
@endsection
