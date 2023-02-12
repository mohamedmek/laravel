@extends('layouts.app')
@section('title')
    index
@endsection
@section('content')
    
  <div class="text-center">
    <a href="{{route('posts.create')}}" class="mt-4 btn btn-success">Create Post</a>
</div>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      {{-- <th scope="col">decription</th> --}}
      <th scope="col">Posted By</th>
      <th scope="col">Created At</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($posts as $post)
        <tr>
            <th scope="row">{{$post['id']}}</th>
            <td>{{$post['title']}}</td>
            {{-- <td>{{$posts['description']}}</td> --}}
            <td>{{$post->user ? $post->user->name : 'user not found'}}</td>
            
            <td>{{$post->created_at->format('Y-m-d')}}</td>
            <td>
                <a href="{{route('posts.show',$post['id'])}}" class="btn btn-info">View</a>
                <a href="{{route('posts.edit',$post['id'])}}" class="btn btn-primary">Edit</a>
                <form action="{{route('posts.destroy',$post['id'])}}" method="POST"  style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td> 
        </tr>
    @endforeach

  </tbody>
</table>

  {{ $posts->links() }}


@endsection
