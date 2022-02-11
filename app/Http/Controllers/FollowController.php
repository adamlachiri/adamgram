<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FollowController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function store($id)
    {

        // get user
        $user = Auth::user();

        // check if valid
        if ($user->id == $id) {
            return redirect("/");
        }

        // check if already master
        foreach ($user->masters as $master) {
            if ($master->master_id == $id) {
                return redirect("/");
            }
        }

        // follow
        Follow::create([
            "follower_id" => $user->id,
            "master_id" => $id
        ]);

        // redirect
        return Redirect::back();
    }

    public function destroy($id)
    {
        // destroy
        $follow = Follow::findOrFail($id);
        $follow->delete();

        // redirect
        return Redirect::back();
    }
}
