<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $req, String $body)
    {
        $comment = new Comment();

        $comment->commentsId = "777";

        $comment->userId = "777";

        $comment->body = $body;

        $comment->save();
    }

    public function getAllForMovie(Request $req, String $movieId)
    {
    }

    public function getAllForUser(Request $req, String $userId)
    {
    }

    public function deleteComment(Request $req, String $commentId)
    {
    }

    public function updateComment(Request $req, String $commentId)
    {
    }
}
