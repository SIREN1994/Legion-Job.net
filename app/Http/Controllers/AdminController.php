<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function applicants(Request $request)
    {
        $records = Record::paginate(4);
        return view('Admin.Applicants', compact('records'));
    }

    public function adminlogin(Request $req)
    {
        // Validate form inputs
        $infs = $req->validate([
            "email" => "required",
            "password" => "required"
        ]);

        // Find the user by email
        $user = Client::where("email", $infs["email"])->first();

        if ($user) {
            // Check if the provided password matches the hashed password
            if (Hash::check($infs["password"], $user->password)) {
                // Check if the user has admin role
                if ($user->role === 'admin') {
                    // Authentication successful, log in the user
                    auth()->login($user);
                    $req->session()->put('user', $user);
                    return redirect('overview');
                } else {
                    // User does not have admin role, redirect back with error message
                    return redirect("/admin")->withErrors(['email' => 'You do not have permission to access the admin panel']);
                }
            } else {
                // Incorrect password, redirect back with error message
                return redirect("/admin")->withErrors(['password' => 'Password is not correct']);
            }
        } else {
            // User not found, redirect back with error message
            return redirect("/admin")->withErrors(['email' => 'Email is not correct']);
        }
    }

    public function adminlogout(Request $req)
    {
        auth()->logout();
        session()->flush();
        return redirect("/");
    }


    public function downcv(Request $request)
    {
        $cvPath = $request->cv_path;

        // Check if the file exists
        if (Storage::exists($cvPath)) {
            // Return the file as a downloadable response
            return response()->download(storage_path('app/' . $cvPath));
        } else {
            // File not found
            return back()->withErrors(['cv_path' => 'CV file not found.']);
        }
    }

    public function datefilter(Request $request)
    {
        // Retrieve start date and end date from the form
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Filter records based on the applied date range
        $records = Record::whereBetween('created_at', [$startDate, $endDate])->get();

        // Pass the filtered records to the view
        return view('Admin.applicants', compact('records'));
    }
}
