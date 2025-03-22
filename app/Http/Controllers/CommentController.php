<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|max:1000',
        ], [
            'content.required' => 'မှတ်ချက် ရေးရန် လိုအပ်ပါသည်။',
            'content.max' => 'မှတ်ချက်သည် စာလုံးရေ ၁၀၀၀ ထက်မကျော်ရပါ။'
        ]);

        $post->comments()->create([
            'content' => $validated['content'],
            'user_id' => auth()->id()
        ]);

        return back();
    }

    public function destroy(Post $post, Comment $comment)
    {
        if ($comment->user_id === auth()->id()) {
            $comment->delete();
        }
        return back();
    }
}