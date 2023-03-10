<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $posts = Post::get()->sortDesc();
        $posts = collect($posts)->paginate(5);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $a = new Post;
        $a->title = $validatedData['title'];
        $a->content = $validatedData['content'];
        $a->author_id = $request->user()->id;
        $a->save();


        if($request->hasFile('image')){
            $url = $request->file('image')->store('', ['disk' => 'images']);
            
            $image = new Image;
            $image->url = $url;

            
            $a->image()->save($image);
        }


        
        session()->flash('message', 'post created');
        return redirect()->route('single_post', ['id' => $a->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', ['post' => $post]);
    }

    public function show_edit($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit', ['post' => $post]);
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
        $post = Post::find($id);
        $validatedData = $request->validate([
            'content' => 'required',
        ]);

        $post->content = $validatedData['content'];
        $post->save();
        session()->flash('message', 'post-edited');
        return redirect()->route('single_post', ['id' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $user_id = $post->author_id;
        $post->delete();
        session()->flash('message', 'post deleted');
        return redirect()->route('my_posts', ['id' => Auth::User()->id])->with('message', 'Post was deleted.');
    }
}
