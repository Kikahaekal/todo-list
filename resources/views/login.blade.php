@extends('layout.layout')

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
        /* backdrop-filter: blur(8px); */
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
    {{-- Bungkus Alert --}}
    @if (session('succes'))
        {{-- <div class="alert alert-success">
            {{ session('succes') }}
        </div> --}}
        <script>
            Swal.fire(
          'Berhasil!',
          'Akun berhasil ditambah!',
          'success'
        )
        </script>
    @endif

    @if(Session::get('notAllowed'))
        {{-- <div class="alert alert-danger">
            {{ Session::get('notAllowed') }}
        </div> --}}
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Login dulu ya!',
                footer: '<p>Register jika tidak memiliki akun.</p>'
            })
        </script>
    @endif
    @if(Session::get('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    {{-- Bungkus Alert --}}

    {{-- <h1 style="font-family: Arial, Helvetica, sans-serif">{{ $content }}</h1>
    <form action="/login/auth" method="post"> --}}
        {{-- @csrf berguna untuk mengambil dan mengirim data input ke controller yang nantinya di ambil Request $request
        @csrf 
        <label for="contohinputUsername" class="mt-3">Username</label>
        <input type="text" name="username" class="form-control" id="contohinputUsername" placeholder="Masukkan Nama">
        <label for="contohinputPassword" class="mt-3">Password</label>
        <input type="password" name="password" class="form-control" id="contohinputPassword">
        <button type="submit" class="btn btn-primary mt-4">Submit</button><br><br>
        <p style="display:inline;">Didn't have an account yet?</p>
        <a href="/register" style="text-decoration:none;">Sign up</a>
    </form> --}}

    <h1 style="font-family: 'Montserrat';" class="mt-5 d-flex justify-content-center">{{ $content }}</h1>
    <div class="container mt-4 d-flex justify-content-center">
        <div class="card w-50 text-center kartu bg-primary">
            <div class="card-header bg-primary" style="border-top-right-radius: 25px; border-top-left-radius:25px;">
                <h2 style="font-family: 'Montserrat'; color:white;">Login</h2>
            </div>
            <div class="card-body">
                <form action="/login/auth" method="post" >
                    @csrf
                    <label for="" style="color: white">Username</label>
                    <input type="text" name="username" class="form-control ipt text-center"><br>
                    <label for="" style="color: white;">Password</label>
                    <input type="password" name="password" class="form-control ipt text-center">
                    <button type="submit" class="btn btn-info mt-3 tmbl" style="color: white">Log-in</button>
                    <a href="/register" class="btn btn-info mt-3 tmbl">Register</a>
                </form>
            </div>
        </div>
    </div>

@endsection