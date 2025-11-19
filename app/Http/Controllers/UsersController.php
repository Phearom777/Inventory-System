<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller

{

    public function register(Request $request)
    {
        // Validate inputs
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255|unique:users,name',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:5',
    ]);

    if (User::where('email',  $request->email)->exists()) {
        return back()->with('error','Email already exists.')->withInput();
    }

    // Create the user without password encryption
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,  // Plain text password
        
    ]);
    // Redirect to login page with success message
    return redirect('/login')->with('success', 'Account registered successfully.');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->has('remember'); // Checkbox named 'remember'
        // Find the user by name
        $user = User::where('email', $email)->first();
    
        if ($user && Hash::check($password, $user->password)) {
            // Laravel handles remember_token automatically
            Auth::login($user, $remember);
    
            // Optional: Still storing custom session data
            session([
                'id' => $user->id,
                'email' => $user->email,
            ]);
    
            return redirect('/'); // Or redirect('/dashboard')
        } else {
            $request->session()->flash('error', 'Invalid Email or password.');
            return redirect('/login');
        }
    }

    public function signOut(Request $rq){
        $rq->session()->flush();
        return redirect('/login');
    }
    
}
