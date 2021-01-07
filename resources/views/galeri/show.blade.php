@extends('dashboard')
 
@section('content')
<title>{{$galeri->title}}</title>
 <div>
    <header style="background: #b6445e; padding: 13px; color: #FFF; font-size: 15pt;">
        <div class="row">
            <div class="col s6 m6">
                <strong>{{$galeri->title}}</strong>
            </div>
        <div class="col s6 m6 right">
            <form action="{{ route('galeri.destroy',$galeri->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="right btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
            </form>
            <a class="right btn btn-secondary" style="margin-right: 10px" href="{{ route('galeri.index') }}"> Back</a>
        </div>
        </div>
    </header>
<div class="container">
    @foreach($image as $fotos) 
      <div class="box">
        <img src="{{ Storage::url($fotos->image) }}">
        <span>{{$galeri->title}}</span>
      </div>
    @endforeach  
    </div>
</div>
@endsection