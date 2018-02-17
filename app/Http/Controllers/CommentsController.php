<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;

class CommentsController extends Controller
{
    public function Store(Post $post)
    {
        $this->validate(request(), [
           'body' => 'required|min:2'
        ]);
        $post->addComment(request('body'), auth()->id());

        return back();
    }

    public function AddReplyComment(Comment $comment)
    {
        $this->validate(request(), [
            'body' => 'required|min:2'
        ]);

        $reply = new Comment();
        $reply->body = request('body');
        $reply->user_id = auth()->id();

        $comment->comments()->save($reply);

        return back()->withMessage('Reply created');
    }

    public function Update(Comment $comment)
    {
        if ($comment->user_id !== auth()->id())
            return back()->withMessage('Permission denied!');

        $this->validate(request(), [
            'body' => 'required'
        ]);
        $comment->update(request()->all());

        return back()->withMessage('Updated');
    }

    public function Destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id())
            return back()->withMessage('Permission denied!');

        $comment->comments()->delete();
        $comment->delete();

        return back()->withMessage('Deleted');
    }
}
