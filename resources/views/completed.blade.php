@extends('layout.main')

@section('isi')
<style>
     body
    {
        background-repeat: no-repeat;
        background-size: cover;
    }

    .data
    {
        font-family: 'Montserrat', sans-serif;
    }

    .txt
    {
        font-size: 25px;
    }

    .crt
    {
        color: black;
    }

    .edit
    {
        color: grey;
        text-decoration: 25px;
        font-size: 20px;
    }

    .edit:hover
    {
        color: black;
        transition: 0.3s;
    }

    .delete
    {
        color: red;
        font-size: 25px;
        text-decoration: none;
    }

    .delete:hover
    {
        color: darkred;
        transition: 0.3s;
    }

    .fnt
    {
        font-size: 25px;
        text-decoration: none;
        color: green;
    }

    .fnt:hover
    {
        color: darkgreen;
        transition: 0.3s;
    }

    .crt:hover
    {
        color: white;
        transition: 0.3s;
    }
</style>

{{-- Pembatas Alert --}}

{{-- Pembatas Alert --}}

<div class="container data">
    <h1 class="ml-2">Sudah selesai</h1>
    <p class="ml-2 d-inline">Total Kegiatan Selesai : {{ $todo->count() }}</p>
    <a href="/todo/create" class="d-inline float-right mr-3 crt" style="text-decoration: none;"><i class="bi bi-plus txt"></i>Create</a>
    <table style="" class="table table-striped table-info mt-3">
        <tr>
            <th class="">Judul</th>
            <th class="">Deskripsi</th>
            <th class="">Tanggal</th>
            <th class="">Status</th>
            <th class="text-center">Aksi</th>
        </tr>
        <tr>
@foreach ($todo as $item)
            <td>{{ $item->title }}</td>
            <td>{{ $item->description }}</td>
            <td>{{ \Carbon\Carbon::parse($item->date)->format('j F, Y') }}</td>
            <td>{{ $item->status == 1 ? "Selsai" : "Belum Selsai" }}</td>
            <td>
                <div class="d-flex justify-content-between">
                    {{-- <i class="bi bi-wrench edit"></i> --}}

                    {{-- delete dari kak fema --}}
                    {{-- apabila berhubungan dengan modifikasi database maka gunakan form --}}
                    <form action="todo/delete/{{ $item->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <a href="/todo/edit/{{ $item->id }}" class=" btn btn-primary text-center">Edit</a>
                        <button type="submit" class="btn btn-danger text-center">Delete</button>
                    </form>

                    {{-- delete dari mulki --}}
                    {{-- <a href="todo/delete/{{ $item->id }}" class="mr-2 text-center hover" data-hover="Hapus"><i class="bi bi-x delete"></i></a> --}}

                    <form action="/todo/completed/{{ $item->id }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success text-center">Done</button>
                    </form>
                    {{-- complete dari mulki --}}
                    {{-- <a href="todo/completed/{{ $item->id }}" class="text-center hover" data-hover="Selesai"><i class="bi bi-check2 fnt"></i></a> --}}
                </div>
            </td>
        </tr>
@endforeach
    </table>
</div>
@endsection