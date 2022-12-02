@extends('layout.layout')

@include('partials.dashboard.navbar')
@section('isi')
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap");

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

    th
    {
        background-color: lightblue;
    }

    td
    {
        background-color: skyblue;
    }
</style>

{{-- Pembatas Alert --}}
@if(Session::get('notAllowed'))
        {{-- <div class="alert alert-success"> --}}
            {{-- {{ Session::get('notAllowed') }} --}}
        {{-- </div> --}}
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Kamu sudah login nih',
                // footer: '<a href="">Why do I have this issue?</a>'
            })
        </script>
@endif
@if (session('succes'))
<script>
    Swal.fire(
  'Berhasil!',
  'Todo berhasil ditambah!',
  'success'
)
</script>
@endif
@if (session('sucessAdd'))
<script>
    Swal.fire(
  'Berhasil!',
  'Todo berhasil di update!',
  'success'
)
</script>
@endif
@if (session('delete'))
<script>
    Swal.fire(
  'Berhasil!',
  'Todo berhasil dihapus!',
  'success'
)
</script>
@endif
@if(session("done"))
<script>
    Swal.fire(
  'Berhasil!',
  'Status berhasil di update!',
  'success'
)
</script>
@endif
{{-- Pembatas Alert --}}

<div class="container data">
    <h1 class="ml-2">Daftar Pekerjaan mu {{ Auth::user()->username }}!</h1>
    <p class="ml-2 d-inline">Total Kegiatan : {{ $todo->count() }}</p>
    <a href="/todo/create" class="d-inline float-right crt" style="text-decoration: none;"><i class="bi bi-plus txt"></i>Create</a>
    {{-- <a href="/selesai" class="d-inline crt float-right mr-3" style="text-decoration: none;">Selesai</a> --}}
    <table class="table table-striped mt-3">
        <tr>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th class="text-center">Aksi</th>
        </tr>
        <tr>
@foreach ($todo as $item)
            <td>{{ $item->title }}</td>
            <td>{{ $item->description }}</td>
            <td>{{ $item->status == 1 ? "Selesai pada ". \Carbon\Carbon::parse($item->done_time)->format('j F, Y') : 'Mulai pada '.\Carbon\Carbon::parse($item->date)->format('j F, Y')}}</td>
            <td>{{ $item->status == 1 ? "Selesai" : "Belum Selesai" }}</td>
            <td>
                <div class="d-flex justify-content-center">
                    {{-- <i class="bi bi-wrench edit"></i> --}}

                    {{-- delete dari kak fema --}}
                    {{-- apabila berhubungan dengan modifikasi database maka gunakan form --}}
                    <form action="todo/delete/{{ $item->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <a href="/todo/edit/{{ $item->id }}" class="btn btn-primary text-center {{ $item->status == 1 ? 'invisible' : 'visible' }}">Edit</a>
                        <button type="submit" class="ml-4 btn btn-danger text-center">Delete</button>
                    </form>

                    {{-- delete dari mulki --}}
                    {{-- <a href="todo/delete/{{ $item->id }}" class="mr-2 text-center hover" data-hover="Hapus"><i class="bi bi-x delete"></i></a> --}}

                    <form action="/todo/completed/{{ $item->id }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="ml-4 btn btn-success text-center {{ $item->status == 1 ? 'invisible' : 'visible' }}">Done</button>
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