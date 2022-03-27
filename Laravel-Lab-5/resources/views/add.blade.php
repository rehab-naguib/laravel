@extends('layouts/app')
@section('title')
    Add Post
@endsection
@section('topcontent')
<form action="{{route("posts.store")}}" method="post">
  @csrf
  {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
  <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label text-white">Id</label>
        <input name="id" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled/>
      </div>
      @if($errors->has('title'))
          <div class="text-danger">{{ $errors->first('title') }}</div>
      @endif
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label text-white">Title</label>
        <input name="title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
      </div>
      @if($errors->has('discription'))
          <div class="text-danger">{{ $errors->first('discription') }}</div>
      @endif
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label text-white">Discription</label>
        <textarea name="discription" id="" cols="30" rows="5" class="form-control" ></textarea>
      </div>
      @if($errors->has('user'))
          <div class="text-danger">{{ $errors->first('user') }}</div>
      @endif
      <div class="mb-3">
        <select name="user" class="form-control" aria-label="Default select example">
          @foreach ($users as $user)
          <option value="{{$user->id}}">{{$user->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label text-white">Posts so far by you: {{$user->numberOfPosts}}</label>
        <input name="numberOfPosts" type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$user->numberOfPosts}}"/>
      </div>
      @if($errors->has('numberOfPosts'))
          <div class="text-danger">{{ $errors->first('numberOfPosts') }}</div>
      @endif
    <button type="submit" class="btn btn-success">Submit</button>
      
</form>
<div class="mt-3">
  <x-button type="primary" href="/posts">Back</x-button>
</div>
@endsection