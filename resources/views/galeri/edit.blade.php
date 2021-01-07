@extends('dashboard')
 
@section('content')
<div class="padding10">
      @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <br>
 <div class="df" style="width: 100%;border: 1px solid #b6445e;">
    <header style="background: #b6445e; padding: 13px; color: #FFF; font-size: 15pt;">
        <strong>Add Gallery
            <a class="right btn btn-secondary" href="{{ route('galeri.index') }}"> Back</a>
        </strong>
    </header>
         <div class="padding10">
            <div class="row">
               <form action="{{ route('galeri.update',$galeri->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col s12 m12">        
                    <img src="{{ Storage::url($galeri->image) }}" height="200" width="200" alt="" />
                <div class="file-field input-field">
                  <div class="btn">
                    <span>Image</span>
                    <input type="file" name="image[]" accept="image/*" class="form-control" multiple>
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload your picture to add gallery's image">
                  </div>
                </div>
                <div class="input-field col s12 m12">
                  <input id="title" type="text" name="title" placeholder="Title" class="validate">
                  <label for="title">Title Galeri</label>
                </div>
                <button type="submit" class="btn btn-primary col s12">Save Galeri</button>
                </div>
            </form>
            </div>
        </div>
            <footer>
            </footer>
            </div>
        </div>
@endsection

<!--  -->
@extends('dashboard')
 
@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Edit Post</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-secondary" href="{{ route('galeri.index') }}"> Back</a>
            </div>
        </div>
    </div>
 
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
 
    <form action="{{ route('galeri.update',$galeri->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
 
         <div class="row">
                 <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Cover</strong>
                <img src="{{ Storage::url($galeri->image) }}" height="200" width="200" alt="" />
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
        </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" value="{{ $galeri->title }}" class="form-control" placeholder="Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
 
    </form>
@endsection