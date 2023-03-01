<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Session;
use Sentinel;

class CustomAuthController extends Controller
{
    public function login(){
        return view("login");
    }

    public function register(){
        return view("register");
    }

    public function registration(Request $request){
        $request->validate([
            'email' => 'email|unique:users',
            'username' => 'unique:users',
            'password' => 'min:5'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'name' => $request->name,
            'surname' => $request->surname,
            'username' => $request->username
        ];

        $user = Sentinel::registerAndActivate($credentials);

        if ($user) {
            return redirect('login')->with('success', 'Η εγγραφή ολοκληρώθηκε');
        } else {
            return back()->with('fail', 'Κάτι πήγε λάθος! Παρακαλώ δοκιμάστε ξανά');
        }
    }

    public function loginUser(Request $request){

        if ($user = Sentinel::authenticate($request->all())) {
            $request->session()->put('loginId', $user->id);
            return redirect('homepage');
        } else {
            return back()->with('fail', 'Λάθος κωδικός πρόσβασης ή όνομα χρήστη');
        }
    }

    public function homepage(){
        $data = array();
        $posts = array();
        $allPosts = array();
        if (Session::has('loginId')) {
            $data = users::find(Session::get('loginId'));
            $posts = Post::where('user_id', Session::get('loginId'))
                ->orderBy('created_at', 'desc')
                ->get();

            $allPosts = Post::with('user')
                ->orderBy('created_at', 'desc')
                ->get();

            $allPosts = Post::select('posts.id','posts.post','posts.created_at', 'users.name', 'users.surname', 'users.username')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->orderBy('posts.created_at', 'desc')
                ->get();
        }
        return view('homepage', compact('data', 'posts','allPosts'));

    }

    public function settings(){
        $data = array();
        if (Session::has('loginId')) {
            $data = users::where('id', '=', Session::get('loginId'))->first();
        }
        return view('settings', compact('data'));
    }

    public function logout(){
        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('login');
        }
    }

    public function changeEmail(Request $request){

        $request->validate([
            'email' => 'email|unique:users'
        ]);

        $user = Sentinel::findById(Session::get('loginId'));
        if ($user = Sentinel::update($user, $request->all())) {
            return redirect('settings')->with('success', 'Η αλλαγή email ολοκληρώθηκε');
        } else {
            return redirect('settings')->with('fail', 'Κάτι πήγε λάθος προσπαθείστε ξανά');
        }
    }

    public function changePass(Request $request){

        $request->validate([
            'password' => 'min:5'
        ]);

        $user = Sentinel::findById(Session::get('loginId'));
        $credentials = ['password' => $request->oldPassword];
        if (Sentinel::validateCredentials($user, $credentials)) {
            $credentials = ['password' => $request->password];
            Sentinel::update($user, $credentials);
            return redirect('settings')->with('success', 'Η αλλαγή του κωδικού ολοκληρώθηκε');
        } else {
            return redirect('settings')->with('fail', 'Ο παλιός κωδικός είναι λάθος');
        }

    }

    public function changeUser(Request $request){
        $request->validate([
            'username' => 'unique:users'
        ]);

        $user = Sentinel::findById(Session::get('loginId'));
        if ($user = Sentinel::update($user, $request->all())) {
            return redirect('settings')->with('success', 'Η αλλαγή username ολοκληρώθηκε');
        } else {
            return redirect('settings')->with('fail', 'Κάτι πήγε λάθος προσπαθείστε ξανά');
        }

    }

    public function uploadImage(Request $request){

        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');

        if ($image) {
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path(), $filename);

            $user = Sentinel::findById(Session::get('loginId'));

            $oldImage = $user->user_image;

            $credentials = ['user_image' => $filename];

            if ($user = Sentinel::update($user, $credentials)) {
                if ($oldImage !== 'default.png') {
                    $path = public_path($filename);
                    Storage::delete($path);
                }
                return back()->with('success', 'Η φωτογραφία σας ανέβηκε');
            } else {
                return back()->with('error', 'Κάτι πήγε λάθος δοκιμάστε ξανά');
            }
        }
    }
}