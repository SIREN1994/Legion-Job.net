<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\Client;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobsController extends Controller
{
    public function addJobs(Request $request)
    {
        $infs = $request->validate([
            'title' => 'required|string|max:255',
            'tags' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:jobs', // Add unique rule for the "email" field
            'website' => 'required|url|max:255',
            'description' => 'required|string',
            'job_description' => 'required|string',
            'job_requirement' => 'required|string',
            'job_category' => 'required|string',
            'posted_date' => 'required|string',
            'logo' => 'image|max:2048', // Adjust image validation as needed
        ]);

        // Explode the tags input into an array
        $tagsArray = explode(',', $request->input('tags'));
        $tagsArray1 = explode(',', $request->input('job_description'));
        $tagsArray2 = explode(',', $request->input('job_requirement'));


        if ($request->hasFile('logo')) {
            // Validate and move the uploaded file
            $request->validate([
                'logo' => 'image|max:2048', // Adjust image validation as needed
            ]);

            $filename = $request->getSchemeAndHttpHost() . '/Jobs_Logos/' . time() . "." . $request->logo->extension();
            $request->logo->move(public_path('Jobs_Logos'), $filename);
        }

        Jobs::create([
            'title' => $request->input('title'),
            'tags' => implode(',', $tagsArray), // Convert array to comma-separated string
            'company' => $request->input('company'),
            'location' => $request->input('location'),
            'email' => $request->input('email'),
            'website' => $request->input('website'),
            'description' => $request->input('description'),
            'job_description' => implode(',', $tagsArray1),
            'job_requirement' => implode(',', $tagsArray2),
            'job_category' => $request->input('job_category'),
            'posted_date' => $request->input('posted_date'),
            'logo' => $filename ?? null, // Store the logo path in the database
        ]);

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Job added successfully!');
    }

    public function jobedit(Request $req)
    {
        $job = Jobs::where("job_id", $req->getID)->first();
        return view("Admin.Editing", ['job' => $job]);
    }


    public function updatejob(Request $request)
    {
        // Validate form fields
        $infs = $request->validate([
            'title' => 'required|string|max:255',
            'tags' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:jobs,email,' . $request->getID . ',job_id', // making current email unique too
            'website' => 'required|url|max:255',
            'description' => 'required|string',
            'job_description' => 'required|string',
            'job_requirement' => 'required|string',
            'job_category' => 'required|string',
            'posted_date' => 'required|string',
            'logo' => 'image|max:2048', // Adjust image validation as needed
        ]);
        // Explode the tags input into an array
        $tagsArray = explode(',', $request->input('tags'));
        $tagsArray1 = explode(',', $request->input('job_description'));
        $tagsArray2 = explode(',', $request->input('job_requirement'));

        // Update the tags field in the database
        $infs['tags'] = implode(',', $tagsArray);
        $infs['job_description'] = implode(',', $tagsArray1);
        $infs['job_requirement'] = implode(',', $tagsArray2);

        $id = $request->getID;

        if ($request->hasFile('logo')) {
            // Validate and move the uploaded file
            $request->validate([
                'logo' => 'image|max:2048', // Adjust image validation as needed
            ]);

            // Delete the existing logo file, if it exists
            $existingLogo = Jobs::where('job_id', $id)->value('logo');
            if ($existingLogo && file_exists(public_path($existingLogo))) {
                unlink(public_path($existingLogo));
            }

            // Move the new logo file
            $filename = $request->getSchemeAndHttpHost() . '/Jobs_Logos/' . time() . "." . $request->logo->extension();
            $request->logo->move(public_path('Jobs_Logos'), $filename);

            // Update the logo field in the database
            $infs['logo'] = $filename;
        }

        Jobs::where('job_id', $id)->update($infs);

        return redirect('/editjobs');
    }

    public function delete(Request $req)
    {
        $id = $req->getID;
        Jobs::where('job_id', $id)->select()->delete();
        return redirect('/editjobs');
    }

    //the predefined user interaction method to show list of choice
    public function show($value)
    {
        $jobs = Jobs::where('job_category', $value)->get();
        return view('Admin.Edit_Jobs', ['jobs' => $jobs]);
    }

    public function company($value)
    {
        $companies = Jobs::where('company', $value)->paginate(6);
        return view('companies', ['companies' => $companies]);
    }

    public function category($value)
    {
        $categories = Jobs::where('job_category', $value)->paginate(6);
        return view('category', ['categories' => $categories]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $jobs = Jobs::where('title', 'like', "%$query%")
            ->orWhere('location', 'like', "%$query%")
            ->orWhere('job_category', 'like', "%$query%")
            ->get();

        return view('Admin.Edit_Jobs', ['jobs' => $jobs]);
    }




    public function query1(Request $request)
    {
        // Retrieve input values from the URL query parameters
        $positionLevel = $request->input('position_level');
        $classification = $request->input('classification');
        $location = $request->input('location');

        // Start building your query
        $query = Jobs::query();

        // Add conditions based on the input values
        if ($positionLevel) {
            $query->where('title', 'like', "%$positionLevel%");
        }

        if ($classification) {
            $query->where('job_category', $classification);
        }

        if ($location) {
            $query->where('location', 'like', "%$location%");
        }

        // Get the results
        $jobs = $query->get();

        // Pass the results to your view or perform any other action
        return view('SearchResult', compact('jobs'));
    }




    public function detailjob(Request $req)
    {
        $jobs = Jobs::where('job_id', $req->getID)->get();
        return view('jobdetail', ['jobs' => $jobs]);
    }


    public function applyjob(Request $request)
    {
        $user = session()->get('user')['name'];
        $user_id = Client::where('name', $user)->value('client_id');
        $user_email = Client::where('name', $user)->value('email');
        $cv = Client::where('client_id', $user_id)->value('resume');
        $jobid = $request->getID;
        $job_title = Jobs::where('job_id', $jobid)->value('title');
        $job_company = Jobs::where('job_id', $jobid)->value('company');

        // Check if a record already exists for the client and job id
        $existingRecord = Record::where('client_id', $user_id)
            ->where('job_id', $jobid)
            ->first();

        if ($existingRecord) {
            return redirect()->intended("/detailjob?_token={$request->_token}&getID={$request->getID}")
                ->with('error', 'You Have Already Applied For This Job');
        } else {
            $record = new Record;
            $record->client_id = $user_id;
            $record->client_name = $user;
            $record->client_email = $user_email;
            $record->job_id = $jobid;
            $record->job_title = $job_title;
            $record->company_name = $job_company;
            $record->cv = $cv;
            $record->save();

            return redirect()->intended("/detailjob?_token={$request->_token}&getID={$request->getID}")
                ->with('success', 'You successfully applied for this job!');
        }
    }
}
