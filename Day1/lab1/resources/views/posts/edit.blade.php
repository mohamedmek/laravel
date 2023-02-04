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
            {{-- <input type="text" name="desc"
            class="form-control"
            value="{{$edit['description']}}"> --}}
        </div>
        <div class="mb-3">
            <label class="form-check-label">Post Creator</label>
    
            <select class="form-control" name="creator">
                <option>Mohamed</option>
                <option>Ahmad</option>
                <option>Mahmoud</option>
                <option selected="selected">{{$edit['author']}}</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
@endsection 


