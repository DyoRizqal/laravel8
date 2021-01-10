@extends('dashboard')
 
@section('content')
<title>Galeri Index</title>
         @if (Auth::guest())
         @elseif(Auth::user()->role==1)
          <header style="background: #b6445e; padding: 13px; color: #FFF; font-size: 15pt;">
              <strong>Galeri</strong>
                  <a class="right btn btn-secondary" href="{{ route('galeri.create') }}"> Create Post</a>
          </header>
          @endif
    <br>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
  <section id="portfolio">
    @foreach ($galeri as $post)
      @php $images =App\Models\Galeri::where('type','galeri')->where('idpost',$post->id)->orderBy('id','DESC')->first(); @endphp
    <div class="project">
      <img class="project__image" src="{{ Storage::url($images->image) }}" />
      <h3 class="grid__title"> {{$post->title}}</h3>
      <div class="grid__overlay">
        <button> <a href="{{ route('galeri.show',$post->id) }}" class="viewbutton">view more</a></button>
      </div>
    </div>
     @endforeach
  </section>
@endsection