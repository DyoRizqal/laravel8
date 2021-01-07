@extends('dashboard')
 
@section('content')
<title>Add Blog Content</title>
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
        <strong>Add Blog Content
            <a class="right btn btn-secondary" href="{{ route('blog.index') }}"> Back</a>
        </strong>
    </header>
         <div class="padding10">
            <div class="row">
            <div class="col s12 m12">
            </div> 
            <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="col s12 m12">          
                <div class="file-field input-field">
                  <div class="btn">
                    <span>Cover</span>
                     <input type="file" name="cover" class="form-control" accept="image/*">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload your picture to change the cover">
                  </div>
                </div>
                <div class="input-field col s12 m12">
                  <input id="title" type="text" name="title" placeholder="Title" class="validate">
                  <label for="title">Title blog</label>
                </div>
                <div class="input-field col s12">
                  <textarea id="content" name="content" class="materialize-textarea"></textarea>
                  <label for="content">Content</label>
                </div>
                <button type="submit" class="btn btn-primary col s12">Save</button>
                </div>
            </form>
            </div>
        </div>
            <footer>
            </footer>
            </div>
        </div>
@endsection
