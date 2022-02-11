<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function create()
    {
        return view("posts/create");
    }

    public function store()
    {
        // prepare data
        $data = [];

        // rules
        $rules = [
            "caption" => ["required", "max:500"],
            "image" => ["required", "mimes:png,jpg,jpeg"]
        ];

        // validation
        $validated = request()->validate($rules);

        // get data
        $image_path = request("image")->store("posts", "public");
        $user_id = Auth::user()->id;

        // inject values
        $data["user_id"] = $user_id;
        $data["caption"] = $validated["caption"];
        $data["image"] = $image_path;

        // store
        Post::create($data);

        // redirect
        return redirect("/profile/" . $user_id);
    }

    public function edit($id)
    {
        // prepare data
        $data = [];

        // insert data
        $data["post"] = Post::findOrFail($id);

        // serve
        return view("posts/edit", $data);
    }

    public function update($id)
    {
        // rules
        $rules = [
            "caption" => ["required", "max:500"],
            "image" => ["mimes:png,jpg,jpeg", "nullable"],
        ];

        // validation
        $data = request()->validate($rules);

        // get data
        $post = Post::findOrFail($id);



        // if new image is uploaded
        if (request("image")) {
            // store new image
            $data["image"] = request("image")->store("posts", "public");

            // delete old image 
            File::delete($post->image);
        }

        // update
        $post->update($data);

        // redirect
        return redirect("/profile/" . Auth::user()->id);
    }
}
