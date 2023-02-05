@extends('layouts.app')
@section('title')
    edit
@endsection
@section('content')

<div style="width: 50%;" class="m-2">
    <form method="POST" action="{{route('posts.update',$edit['id'])}}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{$edit['title']}}">
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea
                name="desc"
                class="form-control"
            >{{$edit['description']}}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-check-label">Post Creator</label>
    
            <select class="form-control" name="user_id">
                @foreach ($users as $user)
                    <option value="{{$user->id}}" @if ($user->id == $edit->user_id) selected @endif>{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
@endsection 


