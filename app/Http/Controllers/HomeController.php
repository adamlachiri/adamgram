<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        Artisan::call("storage:link");
        $this->middleware('auth');
    }

    public function index()
    {
        // prepare data
        $data = [];
        $feed = [];

        // get masters
        $masters = Auth::user()->masters;

        // get masters posts
        foreach ($masters as $follow) {
            array_push($feed, ...$follow->master->posts);
        }

        // insert feed
        $data["feed"]  = collect($feed)->sortByDesc("created_at");

        // dd($data["feed"][0]);

        // serve
        return view('home', $data);
    }

    public function search()
    {
        // prepare data
        $data = [];

        // set rules
        $rules = [
            "username" => ["max:20"]
        ];

        $validated = request()->validate($rules);
        $regex = '%' . $validated["username"] . '%';

        // get data
        $data["users"] = $regex != "%%" ?  User::where('username', 'like', $regex)->get() : collect([]);

        // serve
        return view("profiles/index", $data);
    }

    public function explore()
    {
        // prepare data
        $data = [];

        // get masters
        $masters = Auth::user()->masters;
        $masters_ids = $masters->map(function ($item) {
            return $item->master_id;
        });

        // get suggested users
        $suggested_users = User::whereNotIn("id", $masters_ids)->where("id", "!=", Auth::user()->id)->limit(10)->get();

        // get suggested posts
        $posts = Post::whereNotIn("user_id", $masters_ids)->where("user_id", "!=", Auth::user()->id)->orderBy('created_at', 'desc')->limit(20)->get();

        // get posts
        $data["suggested_users"] = $suggested_users;
        $data["posts"] = $posts;

        // serve
        return view("explore", $data);
    }
}
