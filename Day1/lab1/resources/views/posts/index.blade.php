@extends('layouts.app')
@section('title')
    index
@endsection
@section('content')
    
  <div class="text-center">
    <a href="{{route('posts.create')}}" class="mt-4 btn btn-success">Create Post</a>
    <a href="{{route('posts.restore')}}" class="mt-4 btn btn-success">restore Post</a>
</div>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      {{-- <th scope="col">decription</th> --}}
      <th scope="col">slug</th>
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
            <td>{{$post['slug']}}</td>
            {{-- <td>{{$posts['description']}}</td> --}}
            <td>{{$post->user ? $post->user->name : 'user not found'}}</td>
            
            <td>{{$post->created_at->format('Y-m-d')}}</td>
            <td>
                <a href="{{route('posts.show',$post['id'])}}" class="btn btn-info">View</a>
                <a href="{{route('posts.edit',$post['id'])}}" class="btn btn-primary">Edit</a>

<form style="display:inline;" class="delete-post" action="{{ route('posts.destroy', $post->id) }}"
  method="POST">
  @csrf
  @if ($post->trashed())
      @method('PATCH')
  @else
      @method('DELETE')
  @endif

  <input type="submit" data-bs-toggle="modal" class="btn-danger btn text-light "
      data-bs-target="#myModal" value="Delete">
</form>
</td>
</tr>
@endforeach
</tbody>
</table>

<div class="pt-3">
  {{ $posts->links() }} 

<div class="modal show" id="myModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Are you sure you want to delete?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
        <button type="button" id="modelConfirm" class="btn btn-danger">Delete Anyway</button>
        <button type="button" id="cancel" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.slim.min.js"
integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
<script>
  let deleteForm = document.querySelectorAll('.delete-post');

  let confirmDelete = document.getElementById("modelConfirm");

  deleteForm.forEach(form => {
    form.addEventListener("submit", function(e) {
      e.preventDefault();
      $('#myModal').modal('show')
      confirmDelete.addEventListener('click', function(e) {
        $('#myModal').modal('hide');
        form.submit()
      })
    })
  });
</script>

@endsection
