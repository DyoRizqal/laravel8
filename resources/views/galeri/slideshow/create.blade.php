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
             <form action="{{ route('store_slideshow') }}" method="POST" enctype="multipart/form-data">
                <div class="col s12 m12">
                @csrf            
                <div class="file-field input-field">
                  <div class="btn">
                    <span>Image</span>
                    <input type="file" name="image[]" accept="image/*" class="form-control" multiple>
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload your picture to add slideshow's image">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary col s12">Save Image</button>
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

<!--  -->