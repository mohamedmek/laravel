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
    @foreach($posts as $posts)
        <tr>
            <th scope="row">{{$posts['id']}}</th>
            <td>{{$posts['title']}}</td>
            {{-- <td>{{$posts['description']}}</td> --}}
            <td>{{$posts->user ? $posts->user->name : 'user not found'}}</td>
            
            <td>{{$posts->created_at->format('Y-m-d')}}</td>
            <td>
                <a href="{{route('posts.show',$posts['id'])}}" class="btn btn-info">View</a>
                <a href="{{route('posts.edit',$posts['id'])}}" class="btn btn-primary">Edit</a>
                <form action="{{route('posts.destroy',$posts['id'])}}" method="POST"  style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td> 
        </tr>
    @endforeach
  </tbody>
</table>
{{-- <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModal" role="button">Open first modal</a> --}}

<!-- Modal -->
{{-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        are you sure you want to delete :{{$posts['title']}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
        <button type="button" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div> --}}

@endsection
