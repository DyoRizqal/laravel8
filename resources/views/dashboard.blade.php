  <!DOCTYPE html>
  <html>
    <head>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="{{ URL::asset('/materialize/css/materialize.min.css') }}"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="{{ URL::asset('/css/css.css') }}"  media="screen,projection"/>
      <link rel="shortcut icon" href="{{ Storage::url('public/cover/logo.jpg') }}">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
<div class="navbar-fixed">
<nav>
  <div class="nav-wrapper">
    <a href="{{url('/')}}" class="brand-logo"><img class="responsive-img" src="{{ Storage::url('public/cover/logo.jpg') }}"></a>
    <ul class="right hide-on-med-and-down">
      <li><a href="{{url('blog')}}"><i class="material-icons left">book</i>Blog</a></li>
      <li><a href="{{url('galeri')}}"><i class="material-icons left">collections</i>Galeri</a></li>
      <!-- Dropdown Trigger -->
       @if (Auth::guest())
       <li style="width: 150px;overflow: hidden;"><a class="dropdown-trigger" href="#!" data-target="dropdown1"><i class="material-icons left">supervised_user_circle</i>User<i class="material-icons right">arrow_drop_down</i></a></li>
        @else
        <li style="width: 150px;overflow: hidden;"><a class="dropdown-trigger" href="#!" data-target="dropdown1"><i class="material-icons left">supervised_user_circle</i>Admin<i class="material-icons right">arrow_drop_down</i></a></li>
        @endif
    </ul>
     <ul id="dropdown1" class="dropdown-content">
     	<li><a href="{{ route('slideshow') }}" class="waves-effect waves-light"><i class="material-icons left">slideshow</i>Slideshow</a></li>
        <li class="divider"></li>
        @if (Auth::guest())
        <li><a href="{{url('login')}}" class="waves-effect waves-light"><i class="material-icons left">exit_to_app</i>Login</a></li>
        @else
        <li><a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="waves-effect waves-light"><i class="material-icons left">exit_to_app</i>Logout</a></li>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
        @endif
      </ul>
  </div>
 </nav>
</div>
   <body>
   	<div class="contaier">
    	@yield('content')
    </div>
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="{{url('/materialize/js/materialize.min.js')}}"></script>
	  <script type="text/javascript">
		   $('.dropdown-trigger').dropdown({
	          inDuration: 300,
	          outDuration: 225,
	          hover: true, // Activate on hover
	          belowOrigin: true, // Displays dropdown below the button
	          alignment: 'left' // Displays dropdown with edge aligned to the left of button
	        }
	      );
		    var slideIndex = 0;
			showSlides();

			function showSlides() {
			  var i;
			  var slides = document.getElementsByClassName("mySlides");
			  for (i = 0; i < slides.length; i++) {
			    slides[i].style.display = "none";
			  }
			  slideIndex++;
			  if (slideIndex > slides.length) {slideIndex = 1}
			  slides[slideIndex-1].style.display = "block";
			  setTimeout(showSlides, 3000); // Change image every 2 seconds
			}


	  </script>
    </body>
  </html>