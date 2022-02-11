<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function show($id)
    {
        // prepare vars
        $data = [];
        $master = false;


        // get user data
        $user = User::findOrFail($id);

        $followers = $user->followers;
        foreach ($followers as $follower) {
            if ($follower->follower_id == Auth::user()->id) {
                $master = true;
                $data["follow_id"] = $follower->id;
                break;
            }
        }

        // insert data
        $data["user"] = $user;
        $data["master"] = $master;

        // serve
        return view("profiles/show", $data);
    }

    public function edit()
    {
        // prepare data
        $data = [];

        // insert data
        $data["user"] = Auth::user();

        // serve
        return view("profiles/edit", $data);
    }

    public function update($id)
    {
        // rules
        $rules = [
            "title" => ["max:255", "nullable"],
            "description" => ["max:500", "nullable"],
            "image" => ["mimes:png,jpg,jpeg", "nullable"],
            "url" => ["url", "nullable"],
        ];

        // validation
        $data = request()->validate($rules);

        // get user
        $user = Auth::user();

        // if new image is uploaded
        if (request("image")) {
            // store new image
            $data["image"] = request("image")->store("profiles", "public");

            // delete old image 
            if ($user->profile->image) {
                File::delete($user->profile->image);
            }
        }

        // update
        $user->profile->update($data);

        // redirect
        return redirect("/profile/" . $user->id);
    }
}
