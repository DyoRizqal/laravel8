@extends('dashboard')
 
@section('content')
<title>Blog {{$blog->title}}</title>
    <br>
      <div class="padding10">
         <div class="df" style="width: 100%;border: 1px solid #b6445e;">
    <header style="background: #b6445e; padding: 13px; color: #FFF; font-size: 15pt;">
        <strong>{{$blog->title}} 
            <a class="right btn btn-secondary" href="{{ route('blog.index') }}"> Back</a>
        </strong>
    </header>
         <div class="padding10">
            <div class="row">
            <div class="col s6 m6">
            <img src="{{ Storage::url($blog->cover) }}" style="max-width: 100%" />
            </div>
                <div class="col s6 m6">
                     {{ $blog->content }}
                </div>
            </div>
        </div>
            <footer>
            </footer>
            </div>
      </div>
@endsection