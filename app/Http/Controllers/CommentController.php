<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    public function store(Request $req, String $movieId, String $body)
    {
        $comment = new Comment();

        $comment->commentsId = Str::uuid();

        $comment->userId = "777";

        $comment->body = $body;

        $comment->movieId = $movieId;

        $comment->save();
    }

    public function getAllForMovie(Request $req, String $movieId)
    {
        $comments = Comment::where('movieId', $movieId)->get();

        return $comments;
    }

    public function getAllForUser(Request $req, String $userId)
    {
        $comments = Comment::where('userId', $userId)->get();

        return $comments;
    }

    public function deleteComment(Request $req, String $commentId)
    {
        $comment = Comment::find($commentId);

        $comment->delete();
    }

    public function updateComment(Request $req, String $commentId, String $body)
    {
        $comment = Comment::find($commentId);

        $comment->body = $body;

        $comment->save();
    }
}
