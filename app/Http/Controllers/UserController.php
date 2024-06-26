<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validate form fields
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed:password_confirmation',

        ]);

        // Check for validation errors
        if ($validator->fails()) {
            return redirect('/form')
                ->withErrors($validator)
                ->withInput();
        }

        // Validation passed, create a new user
        $user = Client::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // You may optionally log in the user after registration
        auth()->login($user);
        session()->put(["user" => $user]);
        return redirect('/auth');
    }



    public function login(Request $req)
    {
        // Validate form inputs
        $infs = $req->validate([
            "name" => "required",
            "password" => "required"
        ]);

        // Find the user by name
        $user = Client::where("name", $infs["name"])->first();

        if ($user) {
            // Check if the provided password matches the hashed password
            if (Hash::check($infs["password"], $user->password)) {
                // Authentication successful, log in the user
                auth()->login($user);
                $req->session()->put('user', $user);
                return redirect("/");
            } else {
                // Incorrect password, redirect back with error message
                return redirect('/form')->withErrors(['password' => 'Password is not correct']);
            }
        } else {
            // User not found, redirect back with error message
            return redirect('/form')->withErrors(['name' => 'Username is not correct']);
        }
    }


    public function loginX(Request $req)
    {
        // Validate form inputs
        $infs = $req->validate([
            "email" => "required",
            "password" => "required"
        ]);

        // Find the user by name
        $user = Client::where("email", $infs["email"])->first();

        if ($user) {
            // Check if the provided password matches the hashed password
            if (Hash::check($infs["password"], $user->password)) {
                // Authentication successful, log in the user
                auth()->login($user);
                $req->session()->put('user', $user);
                return redirect()->intended("/detailjob?_token={$req->_token}&getID={$req->getID}");
            } else {
                // Incorrect password, redirect back with error message
                return redirect("/detailjob?_token={$req->_token}&getID={$req->getID}")->withErrors(['password' => 'Password is not correct']);
            }
        } else {
            // User not found, redirect back with error message
            return redirect("/detailjob?_token={$req->_token}&getID={$req->getID}")->withErrors(['email' => 'Email is not correct']);
        }
    }

    public function logout(Request $req)
    {
        auth()->logout();
        session()->flush();
        return view("home");
    }

    public function uploadcv(Request $request)
    {
        // Get the name of the authenticated user
        $name = auth()->user()->name;

        // Validate the uploaded file
        $request->validate([
            'resume' => 'required|file|mimes:pdf', // Adjust maximum file size as needed
        ]);

        // Store the uploaded file
        $resumePath = $request->file('resume')->store('resumes');

        // Update the user's resume path in the database
        $user = Client::where('name', $name)->first();
        if ($user) {
            $user->update(['resume' => $resumePath]);
            // Resume path has been updated successfully
        } else {
            // Handle case where user is not found
        }
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Resume uploaded successfully!');
        //I can use the same code with different function name to use it as CV update function.
    }




    public function updatecv(Request $request)
    {
        // Get the name of the authenticated user
        $name = auth()->user()->name;

        // Validate the uploaded file
        $request->validate([
            'resume' => 'required|file|mimes:pdf', // Adjust maximum file size as needed
        ]);

        // Store the uploaded file
        $resumePath = $request->file('resume')->storeAs('resumes', $request->file('resume')->getClientOriginalName());

        // Update the user's resume path in the database
        $user = Client::where('name', $name)->first();
        if ($user) {
            $user->update(['resume' => $resumePath]);
            // Resume path has been updated successfully
        } else {
            // Handle case where user is not found
        }
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Resume uploaded successfully!');
        //I can use the same code with different function name to use it as CV update function.
    }



    public function viewprofile(Request $request)
    {
        // Check if the 'user' session variable exists
        if ($request->session()->has('user')) {
            // Retrieve the user's name from the session
            $user = $request->session()->get('user')['name'];

            // Retrieve the user's ID and CV from the Client model
            $client = Client::where('name', $user)->first(); // Retrieve the first matching record

            // Check if the client record exists
            if ($client) {
                $id = $client->client_id;
                $cv = $client->resume;
                $records = Record::where('client_id', $id)->get();
            } else {
                // Handle case where client record is not found
                $id = null;
                $cv = null;
            }

            // Pass data to the view
            return view('User.profile', ['user' => $user, 'id' => $id, 'cv' => $cv, 'records' => $records]);
        } else {
            // Handle case where 'user' session variable does not exist
            return redirect('/form')->with('error', 'Please log in to view your profile.');
        }
    }
}
