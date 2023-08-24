<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function deletePost(Post $post)
    {
        //if user doesnot exist and post doesnot exist return to home page
        if(!auth()->check() || auth()->id() !== $post->user_id)
        {
            return redirect('/');
        }

        $post->delete();
        return redirect('/');
    }

    public function actuallyUpdatePost(Post $post, Request $request)
    {
        //if user doesnot exist and post doesnot exist return to home page
        if(!auth()->check() || auth()->id() !== $post->user_id)
        {
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);
        return redirect('/');
    }


    public function showEditScreen(Post $post)
    {
        //if user doesnot exist and post doesnot exist return to home page
        if(!auth()->check() || auth()->id() !== $post->user_id)
        {
            return redirect('/');
        }

        return view('edit-post', ['post' => $post]);
    }


    public function createPost(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        Post::Create($incomingFields);
        return redirect('/');
    }
}
