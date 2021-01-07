<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $blog = Blog::latest()->paginate(5);
 
        return view('blog.index',compact('blog'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
 
    public function create()
    {
        return view('blog.create');
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'title' => 'required',
            'content' => 'required',
        ]);
        $path = $request->file('cover')->store('public/cover');
        $post = new Blog;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->cover = $path;
        $post->save();
        return redirect()->route('blog.index')
                        ->with('success','Blog created successfully.');
    }
 
    public function show(Blog $blog)
    {
        return view('blog.show',compact('blog'));
    }
 
    public function edit(Blog $blog)
    {
        return view('blog.edit',compact('blog'));
    }
 
    public function update(Request $request, $id)
    {
     $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        
        $post = Blog::find($id);
        if($request->hasFile('cover')){
            $request->validate([
              'cover' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $path = $request->file('cover')->store('public/cover');
            $post->cover = $path;
        }
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();   
        return redirect()->route('blog.index')
                        ->with('success','Blog updated successfully');
    }
 
    public function destroy(Blog $blog)
    {
        $blog->delete();
 
        return redirect()->route('blog.index')
                        ->with('success','Blog deleted successfully');
    }
    
}
