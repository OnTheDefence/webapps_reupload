<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
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
        $validatedData = $request->validate([
            'content' => 'required',
        ]);

        $a = new Comment;
        $a->content = $validatedData['content'];
        $a->author_id = $request->user()->id;
        $a->post_id = $request->post_id;
        $a->likes = 0;
        $a->save();

        session()->flash('message', 'comment created');
        return redirect()->route('comment-notification', ['id' => $a->post_id]);
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

    public function show_edit($id)
    {
        $comment = Comment::findOrFail($id);

        return view('comment.edit', ['comment' => $comment]);
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
        $comment = Comment::find($id);
        $validatedData = $request->validate([
            'content' => 'required',
        ]);

        $comment->content = $validatedData['content'];
        $comment->save();
        session()->flash('message', 'comment-edited');
        return redirect()->route('single_post', ['id' => $comment->post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $post_id = $comment->post_id;
        $comment->delete();
        session()->flash('message', 'comment deleted');
        return redirect()->route('comment-notification', ['id' => $post_id]);
    }
}
