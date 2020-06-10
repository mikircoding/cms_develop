@extends('template_backend.home')
@section('sub-judul', 'Edit Tags')
@section('content')

<form action="{{ route('tags.update', $tags->id) }}" method="POST">
    @csrf
    @method('patch')
    <div class="form-group">
        <label>Tags</label>
    <input type="text" class="form-control" name="name" value="{{ $tags->name }}">
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-block">Update tags</button>
    </div>
</form>
    
@endsection