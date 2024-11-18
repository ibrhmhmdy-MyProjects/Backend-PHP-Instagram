<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ids = auth()->user()->following()->wherePivot('confirm',true)->get()->pluck('id');
        $posts = Post::whereIn('user_id',$ids)->latest()->get();
        $suggested_users = auth()->user()->SuggestedUsers();
        return \view('posts.index',\compact(['posts','suggested_users']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return \view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = $request->validate([
            'description' => 'required',
            'image' => ['required','mimes:jpg,png,gif']
        ]);

        $image = $request['image']->store('posts','public');

        $post['image'] = $image;

        $post['slug'] = Str::random(10);

        Auth::user()->posts()->create($post);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return \view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return \view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'image' => ['nullable','mimes:jpg,jpeg,png,gif'],
            'description' => 'required'
        ]);

        if($request->has('image')){
            $image = $request['image']->store('posts','public');
            $data['image'] = $image;
        }

        $post->update($data);
        return \redirect()->route('showPost',$post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Storage::delete('public/'. $post->image);
        $post->delete();
        return \redirect(url('/'));
    }
    public function explore(){
        $posts = Post::whereRelation('user','private_account','=',0)
                    ->whereNot('user_id',auth()->id())
                    ->simplePaginate(12);
        return \view('posts.explore',\compact('posts'));
    }
}
