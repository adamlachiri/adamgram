<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store($post_id)
    {

        // check if post isn't liked already
        if (Like::where("user_id", "=", Auth::user()->id)->where("post_id", "=", $post_id)->count() > 0) {
            return Redirect::back();
        }

        // prepare data
        $data = [];

        // insert ids
        $data["user_id"] = Auth::user()->id;
        $data["post_id"] = $post_id;

        // create like
        Like::create($data);

        // redirect
        return Redirect::back();
    }

    public function destroy($post_id)
    {
        // get the like id
        $like = Like::where("user_id", "=", Auth::user()->id)->where("post_id", "=", $post_id)->first();

        // destroy
        if ($like) {
            $like->delete();
        }

        // redirect
        return Redirect::back();
    }
}
