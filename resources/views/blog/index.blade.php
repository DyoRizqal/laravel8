@extends('dashboard')
 
@section('content')
         <title>Blog Index</title>
         @if (Auth::guest())
         @elseif(Auth::user()->role==1)
          <header style="background: #b6445e; padding: 13px; color: #FFF; font-size: 15pt;">
                <strong>Blog Index</strong>
                    <a class="right btn btn-secondary" href="{{ route('blog.create') }}"> Create Post</a>
          </header>
         @endif
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="padding10">
          <div class="row">
            <div class="col s12 m12">
                @foreach ($blog as $post)
                <div class="col s12 m3">
                  <div class="card">
                    <div class="card-image">
                      <img src="{{ Storage::url($post->cover) }}">
                      <div class="card-title valign-wrapper blogt"style="width: 100%">{{ $post->title }}</div>
                    </div>
                    <div class="card-content">
                      <p>{{ $post->content }}</p>
                    </div>
                    <div class="card-action">
                     <form action="{{ route('blog.destroy',$post->id) }}" method="POST">
                        @if (Auth::guest() || Auth::user()->role!=1)
                        <a class="btn btn-info btn-sm" href="{{ route('blog.show',$post->id) }}" style="width: 100%">Show</a>
                         @elseif(Auth::user()->role==1)
                         <a class="btn btn-info btn-sm" href="{{ route('blog.show',$post->id) }}">Show</a>
                         <a class="btn btn-primary btn-sm" href="{{ route('blog.edit',$post->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                         @endif
                     </form>
                    </div>
                  </div>
                </div>
                @endforeach
            </div>
        </div>
    {!! $blog->links() !!}
    </div>
@endsection