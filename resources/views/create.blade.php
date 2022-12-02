@extends('layout.layout')

{{-- @include('partials.dashboard.navbar') --}}
@section('isi')
<style>
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
    
   {{-- <div class="container content">  
    <form method="post" action="{{ route('store') }}" id="create-form">
        @csrf
      <h3>Create Todo</h3>
      
      <fieldset>
          <label for="">Title</label>
          <input placeholder="title of todo" type="text" name="title">
      </fieldset>
      <fieldset>
          <label for="">Target Date</label>
          <input placeholder="Target Date" type="date" name="date">
      </fieldset>
      <fieldset>
          <label for="">Description</label>
          <textarea placeholder="Type your descriptions here..." tabindex="5" name="description"></textarea>
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
    <form action="{{ route('store') }}" method="post">
        @csrf
        <h1 class="d-flex justify-content-center">Ayo Buat Hal Baru!!!</h1>
        <div class="card mt-5 bground">
            <div class="card-body">
                <label for="" class="ml-1">Judul</label>
                <input type="text" name="title" class="form-control frm" placeholder="Masukkan Judul">
                <label for="" class="ml-1 mt-4">Tanggal</label>
                <input type="date" name="date" class="form-control frm">
                <label for="" class="ml-1 mt-4">Deskripsi</label>
                <textarea name="description" class="form-control frm" rows="5" placeholder="Masukkan Deskripsi"></textarea>
                <button type="submit" class="btn btn-success mt-4 float-right">Submit</button>
                <a href="{{ route('todo.index') }}" class="btn btn-info mt-4 float-right mr-4">Cancel</a>
            </div>
        </div>
    </form>
  </div>

@endsection