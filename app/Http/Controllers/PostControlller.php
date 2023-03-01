<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Session;
use Sentinel;

class PostControlller extends Controller
{
    public function savePosts(Request $request){
        $post = new Post();
        $post->post = $request->input('text');
        $post->user_id = Session::get('loginId'); // Set the user ID to the ID of the logged-in user
        $post->save();

        return back();
    }

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        // Redirect to the posts index page, or wherever you want to go after deletion
        return back();
    }


}
