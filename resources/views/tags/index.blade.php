@extends('template_backend.home')
@section('sub-judul', 'Tags')
@section('content')

@if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session('success') }}
    </div>
@else
    
@endif

<a href="{{ route('tags.create') }}" class="btn btn-icon icon-left btn-primary"><i class="far fa-plus"></i>Tambah Tags</a><br><br>

<table class="table table-striped table-hover-sm table-bordered">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama Tags</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($tags as $result => $hasil)
        <tr>
            <td>{{ $result + $tags->firstitem() }}</td>
            <td>{{ $hasil->name }}</td>
            <td>
                <form action="{{ route('tags.destroy', $hasil->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <a href="{{ route('tags.edit', $hasil->id) }}" class="btn btn-info btn-sm">Edit</a>
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection