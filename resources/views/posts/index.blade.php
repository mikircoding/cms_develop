@extends('template_backend.home')
@section('sub-judul', 'Posts')
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


<a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">Tambah Posts</a><br><br>

<table class="table table-bordered table-striped table-hover-sm ">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama Posts</td>
            <td>Kategori</td>
            <td>Gambar</td>
            <td>Tags</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $result => $hasil )
        <tr>
            <td>{{ $result + $posts->firstitem() }}</td>
            <td>{{ $hasil->judul }}</td>
            <td>{{ $hasil->category->name }}</td>
            <td><img src="{{ asset($hasil->gambar) }}" class="img-fluid" style="width:100px"></td>
            <td>
                @foreach ($hasil->tags as $tag)
                    <ul>
                        <li> {{ $tag->name }} </li>
                    </ul>
                @endforeach
            </td>
            <td>
                <form action="" method="POST">
                    <a href=" {{ route('posts.edit', $hasil->id) }} " class="btn btn-info btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm">delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
