<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use App\Models\GaleriT;
use App\Models\User;
use Auth;
class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $galeri = GaleriT::latest()->paginate(5);
        $image = Galeri::where('type','galeri')->get(); 
        return view('galeri.index',compact('galeri','image'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
 
    public function show(GaleriT $galeri)
    {
        $image = Galeri::where('idpost',$galeri->id)->get();  
        return view('galeri.show',compact('galeri','image'));
    }

    public function create()
    {
        if (Auth::guest()){
        return redirect()->route('galeri.index');
        }
        else{
             if(Auth::User()->role == 1){
             return view('galeri.create');
             }
            else{
            return redirect()->route('galeri.index');
            }
        }
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $post = new GaleriT;
        $post->title = $request->title;

        $post->save();

         $this->validate($request, [
                'image' => 'required',
                'image.*' => 'image'
        ]);
        $idpost = GaleriT::orderBy('id', 'desc')->first();
    //     $input=$request->all();
    //     $images=array();
    //     if($files=$request->file('image')){
    //     foreach($files as $file){
    //         $name=$file->getClientOriginalName();
    //         $file->move('images',$name);
    //         $images[]=$name;
    //     }
    //     Galeri::insert( [
    //     'image'  => implode($images),
    //     'idpost' => $idpost->id,
    //     //you can put other insertion here
    // ]);
    // }
        $fotos = $request->file('image');
         foreach($fotos as $foto){
           $fotoName = strtoupper(str_slug(strtoupper($idpost->title)))."-".date("YmdHis").uniqid().".".$foto->getClientOriginalExtension();
           $path = $foto->store('public/images');
           $fgaleri = new Galeri;
           $fgaleri->idpost = $idpost->id;
           $fgaleri->image = $path;
           $fgaleri->type = 'galeri';
           $fgaleri->save();
 };

        return redirect()->route('galeri.index')->with('success','Galeri created successfully.');
    }
 
 
    public function edit(Galeri $galeri)
    {
        if (Auth::guest()){
        return redirect()->route('galeri.index');
        }
        else{
             if(Auth::User()->role == 1){
             return view('galeri.edit',compact('galeri'));
             }
             else{
             return redirect()->route('galeri.index');
            }
        }
    }
 
    public function update(Request $request, $id)
    {
     $request->validate([
            'title' => 'required',
        ]);
        
        $post = Galeri::find('idpost',$id);
        if($request->hasFile('image')){
            $request->validate([
              'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $path = $request->file('image')->store('public/images');
            $post->image = $path;
        }
        $post->idpost = $id;
        $post->title = $request->title;
        $post->save();
        return redirect()->route('galeri.index')
                        ->with('success','Galeri updated successfully');
    }
    public function destroy(GaleriT $galeri)
    {
        $galeri->delete();
        $image = Galeri::where('idpost',$galeri->id);  
        $image->delete();
        return redirect()->route('galeri.index')
                        ->with('success','Galeri deleted successfully');
    }

    //Slideshow

      public function slideshow()
    {
        
        $image = Galeri::where('type','slideshow')->orderBy('id','ASC')->get(); 
        return view('galeri.slideshow.index',compact('image'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create_slideshow()
    {
        return view('galeri.slideshow.create');
    }

    public function store_slideshow(Request $request)
    {
         $this->validate($request, [
                'image' => 'required',
                'image.*' => 'image'
        ]);
        $fotos = $request->file('image');
         foreach($fotos as $foto){
           $fotoName = strtoupper(str_slug(strtoupper('slideshow')))."-".date("YmdHis").uniqid().".".$foto->getClientOriginalExtension();
           $path = $foto->store('public/images');
           $fgaleri = new Galeri;
           $fgaleri->image = $path;
           $fgaleri->type = 'slideshow';
           $fgaleri->save();
        };
           return redirect()->route('slideshow')->with('success','Galeri created successfully.');
    }
    public function destroy_slideshow(Galeri $galeri,$id)
    {
        $galeri = Galeri::find($id);
        $galeri->delete();
        return back();
    }
    public function update_slideshow(Request $request)
    {
     $request->validate([
         'image' => 'required',
        ]);
        $id = $request->input('id');
        $post = Galeri::find($id);
        echo "$request->file('image')";
        $path = $request->file('image')->store('public/images');
        $post->image = $path;
        $post->type ='slideshow';
        $post->save();   
        return redirect()->route('slideshow')->with('success','Slideshow updated successfully.');
    }
 
}