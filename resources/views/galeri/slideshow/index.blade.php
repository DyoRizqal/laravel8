@extends('dashboard')
 
@section('content')
<title>SlideShow</title>
          <header style="background: #b6445e; padding: 13px; color: #FFF; font-size: 15pt;">
            <strong>Blog Index</strong>
                <a class="right btn btn-secondary" href="{{ route('create_slideshow') }}"> Create Slideshow</a>
          </header>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <br>
        <div class="slideshow-container">
            @php $image =App\Models\Galeri::where('type','slideshow')->orderBy('id','ASC')->skip(0)->take(5)->get(); @endphp
             @foreach($image as $fotos)  
             <div class="mySlides fade">
               <div class="numbertext">PREVIEW</div>
               <img src="{{ Storage::url($fotos->image) }}"> 
             </div>
            @endforeach
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>
        <br>
      <table id="slide">
          <tr>
            <th style="text-align: center;">No.</th>
            <th style="text-align: center;">Image</th>
            <th style="text-align: center;">Change Picture</th>
            <th style="text-align: center;" colspan="2">Action</th>
          </tr>
            @foreach ($image as $post)
                <tr>
                    <td class="text-center"><b>{{ ++$i }}</b></td>
                    <td class="text-center list"><img src="{{ Storage::url($post->image) }}"></td>
                    <td> 
                      <form action="{{ route('update_slideshow',$post->id) }}" method="POST" enctype="multipart/form-data"> 
                              @csrf
                        <div class="file-field input-field">
                            <div class="btn">
                            <i class="material-icons left">image</i>
                            <input type="hidden" value="{{$post->id}}" name="id">
                            <input type="file" name="image" accept="image/*" class="form-control" multiple>
                          </div>
                          <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                          </div>
                        </div>
                    </td>
                    <td class="med20">
                       <button type="submit" class="btn btn-primary"><i class="material-icons left">save</i>Save</button>
                    </td>
                    </form>
                    <form action="{{ route('destroy_slideshow',$post->id) }}" method="POST"> 
                        @csrf
                        @method('DELETE')         
                    <td class="med20"><button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="material-icons left">delete</i>Delete</button></td>
                    </form>
                </tr>
        @endforeach
        </tbody>
      </table>
      
@endsection