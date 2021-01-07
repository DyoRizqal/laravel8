@extends('dashboard')
@section('content')
<title>Welcome HijrahQolbu</title>
		<div class="slideshow-container">
            @php 
            $image =App\Models\Galeri::where('type','slideshow')->orderBy('id','DESC')->skip(0)->take(5)->get();
            $title = App\Models\GaleriT::orderBy('id','DESC')->skip(0)->take(1)->get();
            $blog = App\Models\Blog::latest()->paginate(5); 
            @endphp
             @foreach($image as $fotos)  
             <div class="mySlides fade">
               <img src="{{ Storage::url($fotos->image) }}"> 
             </div>
            @endforeach
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
		   	<div class="row">
		   		<div class="col s12 m12">
		   			@if(count($blog)==0)
					@else
		   			<div class="col s12 m9">
		   			<div class="df" style="width: 100%;border: 1px solid #b6445e;">
				    <header style="background: #b6445e; padding: 13px; color: #FFF; font-size: 15pt;">
				        <strong> Blog</strong>
				    </header>
				   	@foreach ($blog as $post)
				   <div class="row">
				    <div class="col s12 m6">
				      <div class="card">
				        <div class="card-image">
				          <img src="{{ Storage::url($post->cover) }}">
				          <div class="card-title valign-wrapper blogt"style="width: 100%">{{ $post->title }}</div>
				        </div>
				        <div class="card-content">
				          <p>{{ $post->content }}</p>
				        </div>
				        <div class="card-action">
				          <a href="{{ route('blog.show',$post->id) }}" class="colorp">Baca selengkapnya</a>
				        </div>
				      </div>
		    		</div>
		  		    </div>
		  			@endforeach
					</div>
					</div>	
					@endif
					@if(count($title)==0)
					@else
				<div class="col s12 m3">
				<div class="df" style="width: 100%;border: 1px solid #b6445e;">
			    <header style="background: #b6445e; padding: 13px; color: #FFF; font-size: 15pt;">
			        <strong> Gallery</strong>
			    </header>
				  @foreach ($title as $post)
				 	
				   <div class="row">
				    <div class="col s12 m12">
				    <a href="{{ route('galeri.show',$post->id) }}">
				      <div class="card">
				        <div class="card-image">
				          <img src="{{ Storage::url($images->image) }}">
				           <div class="card-title valign-wrapper blogt"style="width: 100%">{{ $post->title }}</div>
				        </div>
				      </div>
				  	</a>
		    	    </div>
		  		   </div>
		  			@endforeach
				</div>
				</div>
				@endif
		</div>
	</div>
@endsection