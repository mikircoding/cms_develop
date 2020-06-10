@extends('template_backend.home')
@section('sub-judul', 'Tambah Posts')
@section('content')

@if (count($errors)>0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{ $error }}    
        </div>    
    @endforeach
@endif

@if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session('success') }}
    </div>
@else
    
@endif

    <form action=" {{ route('posts.update', $posts->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <label>Judul</label>
        <input type="text" class="form-control" name="judul" value=" {{ $posts->judul }} ">
    </div>
    <div class="form-group">
        <label>Kategori</label>
        <select class="form-control" name="category_id">
            <option value="" holder>Pilih Kategori</option>
            @foreach($category as $result)
            <option value="{{ $result->id }}"
                    @if ($posts->category_id == $result->id)
                        selected
                    @endif         
            > {{ $result->name }} </option>
            @endforeach    
        </select>    
    </div>
    <div class="form-group">
        <label>Pilih Tags</label>
        <select value="" class="form-control select2" multiple="" name="tags[]">
            @foreach ($tags as $tag)
            <option value="{{ $tag->id }}"
                @foreach ($posts->tags as $value)
                    @if ($tag->id == $value->id)
                        selected
                    @endif
                @endforeach    
            > {{ $tag->name }} </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
          <label>Konten</label>
          <textarea name="content" class="form-control">{{ $posts->content }}</textarea>  
    </div>
    <div class="form-group">
        <label>Thumbnail</label>
        <input type="file" name="gambar" class="form-control" value=" {{ $posts->gambar }} ">
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-block">Simpan POST</button>
    </div>  

</form>

@endsection