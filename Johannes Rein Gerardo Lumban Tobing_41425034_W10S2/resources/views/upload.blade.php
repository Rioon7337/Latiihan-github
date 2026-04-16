@extends('layout')
@section('title', 'Tugas PSW 2')


@section('form')
<form action="/upload" method="POST" enctype="multipart/form-data">
    @csrf
    <h2>Upload Foto</h2> <br>
    <input type="text" name="nama" placeholder="Nama"><br><br>

    <input type="file" name="gambar"><br><br>

    <button type="submit">Upload</button>
</form>
@endsection

@section('content')
<table class="table table-bordered">
    <tr>
        <th>Nama</th>
        <th>Gambar</th>
        <th>Action</th>
    </tr>

@foreach ($uploads as $upload)
    <tr>
        <td>{{ $upload->nama }}</td>
        <td>
            <img src="{{ asset('images/'.$upload->gambar) }}" width="120">
        </td>
        <td>
            <form action="{{ route('uploads.destroy', $upload->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus gambar ini?')">Hapus</button>
            </form>
        </td>
    </tr>
@endforeach

</table>

{{ $uploads->links() }}

@endsection