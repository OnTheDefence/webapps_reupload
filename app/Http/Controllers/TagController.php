<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request);
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();

        $post = Post::find($request->post_id);
        $post->tags()->attach($tag);

        return redirect()->route('single_post', ['id' => $post->id]);
    }

    public function attach(Request $request)
    {
        $tag = Tag::find($request->tag_id);
        $post = Post::find($request->post_id);
        $post->tags()->attach($tag);

        return redirect()->route('single_post', ['id' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $tag = Tag::find($request->tag_id);
        $tag->posts()->detach();
        $tag->delete();

        return redirect()->route('profile.edit')->with('status', 'tag-deleted');
    }
}
