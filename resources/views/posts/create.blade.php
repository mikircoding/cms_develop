@extends('template_backend.home')
@section('sub-judul', 'Tambah Posts')
@section('content')

@if (count($errors)>0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="close" data-dismis="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>    
        </div>    
    @endforeach
@endif

@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session('success') }}
        <button type="button" class="close" data-dismis="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>  
    </div>
@else
    
@endif

    <form action=" {{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Judul</label>
        <input type="text" class="form-control" name="judul" >
    </div>
    <div class="form-group">
        <label>Kategori</label>
        <select class="form-control" name="category_id">
            <option value="" holder>Pilih Kategori</option>
            @foreach($category as $result)
            <option value="{{ $result->id }}"> {{ $result->name }} </option>
            @endforeach    
        </select>    
    </div>
    <div class="form-group">
        <label>Pilih Tags</label>
        <select value="" class="form-control select2" multiple="" name="tags[]">
            @foreach ($tags as $tag)
            <option value="{{ $tag->id }}"> {{ $tag->name }} </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
          <label>Konten</label>
          <textarea name="content" class="form-control"></textarea>  
    </div>
    <div class="form-group">
        <label>Thumbnail</label>
        <input type="file" name="gambar" class="form-control">
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-block">Simpan POST</button>
    </div>  

</form>

@endsection