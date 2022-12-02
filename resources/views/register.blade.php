@extends('layout.main')

@section('isi')
<style>
    body
    {
        background-repeat: no-repeat;
        background-size: cover;
    }
    .ipt
    {
        border-radius: 50px;
    }

    .kartu
    {
        border-radius: 25px;
    }

    .btn
    {
        border-radius: 10px;
    }

    .tmbl:hover
    {
        background-color: #0275d8;
        transition: 0.5s;
    }
</style>
    {{-- <h1 style="font-family: Arial, Helvetica, sans-serif">{{ $content }}</h1>
    <form action="/register/input" method="post"> --}}
        {{-- csrf berguna untuk mengambil input ke database --}}
        {{-- @csrf
        <label for="contohinputNama" class="mt-2">Nama</label>
        <input type="text" name="name" class="form-control" id="contohinputNama" placeholder="Masukkan Nama">
        <label for="contohinputUser" class="mt-3">Username</label>
        <input type="text" name="username" class="form-control" id="contohinputUser" placeholder="Masukkan Nama">
        <label for="contohinputEmail" class="mt-3">Email</label>
        <input type="email" name="email" class="form-control" id="contohinputEmail" placeholder="Masukkan Email">
        <small id="emailHelp" class="form-text text-muted">Email tidak akan di bagikan ke siapapun</small>
        <label for="contohinputPassword" class="mt-3">Password</label>
        <input type="password" name="password" class="form-control" id="contohinputPassword">
        <button type="submit" class="btn btn-primary mt-4">Add</button>
        <button type="submit" class="btn btn-secondary mt-4 ml-1"><a href="/" style="text-decoration:none; color:white;">Back</a></button>
    </form><br> --}}
    <h1 style="font-family: 'Montserrat';" class="mt-5 d-flex justify-content-center">{{ $content }}</h1>
    <div class="container mt-4 d-flex justify-content-center">
        <div class="card w-50 text-center kartu bg-primary">
            <div class="card-header bg-primary" style="border-top-right-radius: 25px; border-top-left-radius:25px;">
                <h2 style="font-family: 'Montserrat'; color:white;">Register</h2>
            </div>
            <div class="card-body">
                <form action="/register/input" method="post" >
                    @csrf
                    <label for="" style="color: white" class="mt-2">Name</label>
                    <input type="text" name="name" class="form-control ipt text-center">
                    <label for="" style="color: white" class="mt-2">Username</label>
                    <input type="text" name="username" class="form-control ipt text-center">
                    <label for="" style="color: white" class="mt-2">Email</label>
                    <input type="email" name="email" class="form-control ipt text-center">
                    <label for="" style="color: white;" class="mt-2">Password</label>
                    <input type="password" name="password" class="form-control ipt text-center">
                    <button type="submit" class="btn btn-info mt-3 tmbl" style="color: white">Submit</button>
                    <a href="/" class="btn btn-info mt-3 tmbl">Back</a>
                </form>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection