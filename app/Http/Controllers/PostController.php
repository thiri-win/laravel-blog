<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('post.index', [
            'posts' => Post::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'photo' => 'required',
        ], [
            'title.required' => "ခေါင်းစဥ်က လိုအပ်ပါတယ်",
            'content.required' => "အကြောင်းအရာ လိုအပ်ပါတယ်",
            'photo.required' => 'ပုံ ထည့်ရန် လိုအပ်ပါတယ်'
        ]);
        $validated['photo'] = $request->file('photo')->store('photos');
        $validated['user_id'] = auth()->id();
        Post::create($validated);
        session()->flash('success', 'Post created successfully.');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.view', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if($request->user()->cannot('update', $post)) {
            abort(403);
        }
        $validated = $request->validate([
            'title' => 'required',
            'content' =>'required',
        ]);
        if($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('photos');
        }
        $post->update($validated);
        session()->flash('warning', 'Post updated successfully.');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        session()->flash('deleted', 'Post deleted successfully.');
        return redirect()->route('posts.index');
    }

    public function like(Post $post)
    {
        $post->likes()->create([
            'user_id' => auth()->id()
        ]);
        
        return back();
    }
    
    public function unlike(Post $post)
    {
        $post->likes()
            ->where('user_id', auth()->id())
            ->delete();
        
        return back();
    }
}
