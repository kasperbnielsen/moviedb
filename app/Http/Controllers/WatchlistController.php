<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Watchlist;

class WatchlistController extends Controller
{
    function addToWatchlist(String $movie_id, string $user_id)
    {

        $entity = new Watchlist();

        $entity->user_id = $user_id;

        $entity->movie_id = $movie_id;

        $entity->save();
    }
}
