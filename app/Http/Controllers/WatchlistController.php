<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Watchlist;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
class WatchlistController extends Controller
{
    function addToWatchlist(String $movie_id, string $user_id)
    {

        $entity = new Watchlist();

        $entity->user_id = $user_id;

        $entity->movie_id = $movie_id;

        $entity->save();
    }

    function removeFromWatchlist()
    {
        $user = request()->input('user_id');
        $movie = request()->input('movie_id');

        $watchlist = Watchlist::where('user_id', $user)->where('movie_id', $movie);

        $watchlist->delete();
    }

    function getWatchlist()
    {
        $watchlist = Watchlist::where('user_id', '=', request()->user_id)->where('movie_id', '=', request()->movie_id)->get();

        return $watchlist;
    }

    function getUserWatchlist()
    {
        $watchlist = Watchlist::where('user_id', request()->user_id)->get();

        return $watchlist;
        $perPage = 10;

        $userWatchlist = Watchlist::where('user_id', request()->user_id);

        // Check for sorting order in the request
        $sortOrder = request()->input('sort_order', 'desc');
        $sortBy = 'created_at'; // default sorting by creation date

        // Optional: You can add more conditions or customize based on user input
        $userWatchlist->orderBy($sortBy, $sortOrder);

        $watchlist = $userWatchlist->paginate($perPage);

        return view('watchlist.index', ['watchlist' => $watchlist]);
    }
}
