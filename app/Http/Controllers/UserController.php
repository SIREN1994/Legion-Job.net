<?php

namespace App\Http\Controllers;

use App\Mail\Push;
use App\Models\Client;
use App\Models\Record;
use App\Mail\Newpassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
            'password' => Hash::make($request->input('password')), // Hash the password using Bcrypt
        ]);

        // You may optionally log in the user after registration
        auth()->login($user);
        session()->put(["user" => $user]);
        return redirect('/');
    }



    public function login(Request $req)
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

                if ($user->role === 'admin') {
                    auth()->login($user);
                    $req->session()->put('user', $user);
                    return view('Admin.adminpanel');
                } else {
                    auth()->login($user);
                    $req->session()->put('user', $user);
                    return redirect("/");
                }
            } else {
                // Incorrect password, redirect back with error message
                return redirect('/form2')->withErrors(['password' => 'Password is not correct']);
            }
        } else {
            // User not found, redirect back with error message
            return redirect('/form2')->withErrors(['email' => 'Email is not correct']);
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
                if ($user->role === 'admin') {
                    auth()->login($user);
                    $req->session()->put('user', $user);
                    return view('Admin.adminpanel');
                } else {
                    auth()->login($user);
                    $req->session()->put('user', $user);
                    return redirect("/");
                }
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
        return redirect("/");
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
                $pp = $client->profilepic;
                if (!$pp) {
                    $pp = "https://static.vecteezy.com/system/resources/previews/029/825/357/original/default-avatar-profile-icon-isolated-on-white-background-social-media-user-sign-symbol-vector.jpg";
                }
                $records = Record::where('client_id', $id)->get();
            } else {
                // Handle case where client record is not found
                $id = null;
                $cv = null;
            }

            // Pass data to the view
            return view('User.profile', ['user' => $user, 'id' => $id, 'cv' => $cv, 'records' => $records, 'pp' => $pp]);
        } else {
            // Handle case where 'user' session variable does not exist
            return redirect('/form')->with('error', 'Please log in to view your profile.');
        }
    }

    //Single Column Update Method
    public function uploadpfp(Request $request)
    {
        $id = session()->get('user')['id'];
        $infs = $request->validate([
            'profilepic' => 'image'
        ]);

        if ($request->hasFile('profilepic')) {
            // Validate and move the uploaded file
            $request->validate([
                'profilepic' => 'image|max:2048', // Adjust image validation as needed
            ]);

            // Delete the existing logo file, if it exists
            $existingLogo = Client::where('client_id', $id)->value('profilepic');
            if ($existingLogo && file_exists(public_path($existingLogo))) {
                unlink(public_path($existingLogo));
            }

            // Move the new logo file
            $filename = $request->getSchemeAndHttpHost() . '/Profile_pics/' . time() . "." . $request->profilepic->extension();
            $request->profilepic->move(public_path('Profile_pics'), $filename);

            // Update the logo field in the database
            $infs['profilepic'] = $filename;
        }

        $client = Client::find($id);
        $client->profilepic = $filename;
        $client->save();


        return redirect()->back()->with('success', 'Profile Picture uploaded successfully!');
    }


    public function changepassword(Request $request)
    {
        $client = session()->get('user')['name'];

        if (empty($request->oldpass) || empty($request->newpass)) {
            return redirect()->back()->with('error', 'Both old and new passwords are required.');
        }

        $validatedData = $request->validate([
            "oldpass" => "required",
            "newpass" => "required"
        ], [
            'oldpass.required' => 'Old password is required.',
            'newpass.required' => 'New password is required.'
        ]);

        $user = Client::where("name", $client)->first();

        if ($user) {
            // Check if the provided old password matches the hashed password
            if (Hash::check($validatedData["oldpass"], $user->password)) {
                // Hash the new password
                $newPassword = Hash::make($validatedData['newpass']);
                // Update the user's password
                $user->password = $newPassword;
                $user->save();
                return redirect()->back()->with('success', 'Password changed successfully.');
            } else {
                return redirect()->back()->with('error', 'Incorrect current password.');
            }
        }
    }

    public function newpassword(Request $request)
    {
        $infs = $request->validate(['email' => 'required']);
        $email = $request->email;
        $user = Client::where("email", $email)->first();

        if ($user) {
            $token = Str::random(10);
            $raw = $token;

            // Save the token in the database

            $user->password = Hash::make($token);
            $user->save();
            Mail::to($email)->send(new Push($raw));
            return view('notify');
        } else {
            return redirect()->back()->with('error', 'No User Found, Enter The Email Correctly')->withInput();
        }
    }


    public function uploadX(Request $request)
    {
        $id = session()->get('user')['id'];
        $request->validate([
            'profilepic' => 'image',
        ]);

        if ($request->hasFile('profilepic')) {
            $file = $request->file('profilepic');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = '/Pix/';
            $file->move(public_path($path), $filename);
        }
        $client = Client::find($id);
        $client->profilepic = $path . $filename;
        $client->save();

        return redirect()->back()->with('success', 'Profile Picture uploaded successfully!');
    }
}
