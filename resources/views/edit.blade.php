@extends('layout.layout')

{{-- @include('partials.dashboard.navbar') --}}
@section('isi')
<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap");
    body
    {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .bground
    {
        background-color: rgba(173, 216, 230,0.8);
    }

    .frm
    {
        background-color: rgba(255, 255, 255,0.8)
    }
</style>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- atribut value berfungsi memasukkan data ke input --}}
    {{-- kenapa datanya harus disimpan di input? karena ini fitur edit, kalau fitur edit belum tentu semua data di column di ubah jadi buat antisipasi itu tampilin dulu data di semua inputnya, nantinya pengguna yang menentukan data input mana yang mau diubah --}}
   {{-- <div class="container content">  
    <form method="post" action="/todo/update/{{ $todo->id }}" id="create-form"> --}}

        {{-- mengambil dan mengirim data ke controller yang nantinya akan diterima oleh Request $request --}}
        {{-- @csrf --}}

        {{-- @method berguna untuk menimpa method yang ada di form --}}
        {{-- karena method pacth tidak ada di atribut method di form --}}
        {{-- @method('PATCH') --}}
      {{-- <h3>Edit Todo</h3>
      
      <fieldset>
          <label for="">Title</label>
          <input placeholder="title of todo" type="text" name="title" value="{{ $todo->title }}">
      </fieldset>
      <fieldset>
          <label for="">Target Date</label>
          <input placeholder="Target Date" type="date" name="date" value="{{ $todo->date }}">
      </fieldset>
      <fieldset> --}}
        {{-- textarea tidak termasukn input, jadi untuk menampilkan valuenya simpan di tengah tag nya aja --}}
          {{-- <label for="">Description</label>
          <textarea placeholder="Type your descriptions here..." tabindex="5" name="description">{{ $todo->description }}</textarea>
      </fieldset>
      <fieldset>
          <button type="submit" id="contactus-submit">Submit</button>
      </fieldset>
      <fieldset>
          <a href="{{ route('todo.index') }}" class="btn-cancel btn-lg btn">Cancel</a>
      </fieldset>
    
    </form>
  </div> --}}
  <div class="container mt-5 cl">
    <form action="/todo/update/{{ $todo->id }}" method="post">
        @csrf
        @method('PATCH')
        <h1 class="d-flex justify-content-center">Jangan Lupa Minum Air ya!!!</h1>
        <div class="card mt-5 bground">
            <div class="card-body">
                <label for="" class="ml-1">Judul</label>
                <input type="text" name="title" class="form-control frm" value="{{ $todo->title }}" placeholder="Masukkan Judul">
                <label for="" class="ml-1 mt-4">Tanggal</label>
                <input type="date" name="date" value="{{ $todo->date }}" class="form-control frm">
                <label for="" class="ml-1 mt-4">Deskripsi</label>
                <textarea name="description" class="form-control frm" rows="5" placeholder="Masukkan Deskripsi">{{ $todo->description }}</textarea>
                <button type="submit" class="btn btn-success mt-4 float-right">Submit</button>
                <a href="{{ route('todo.index') }}" class="btn btn-info mt-4 float-right mr-4">Cancel</a>
            </div>
        </div>
    </form>
  </div>
@endsection