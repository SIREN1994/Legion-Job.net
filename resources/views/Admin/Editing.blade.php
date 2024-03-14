@extends('Admin.adminpanel')
@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-semibold mb-6">Edit Job</h2>

    
        <!-- Registration Form -->
        <form action="/updatejob" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Job Title -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-600">Job Title</label>
                <textarea id="title" name="title" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">{{ $job->title }}</textarea>
            </div>

            <!-- Job Tags -->
            <div class="mb-4">
                <label for="tags" class="block text-sm font-medium text-gray-600">Tags</label>
                <textarea id="tags" name="tags" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">{{ $job->tags }}</textarea>
            </div>

            <!-- Company -->
            <div class="mb-6">
                <label for="company" class="block text-sm font-medium text-gray-600">Hiring Company</label>
                <textarea id="company" name="company" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">{{ $job->company }}</textarea>
            </div>

            <!-- Location -->
            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-600">Location</label>
                <textarea id="location" name="location" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">{{ $job->location }}</textarea>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                <textarea id="email" name="email" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">{{ $job->email }}</textarea>
            </div>

            <!-- Website -->
            <div class="mb-4">
                <label for="website" class="block text-sm font-medium text-gray-600">Website</label>
                <textarea id="website" name="website" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">{{ $job->website }}</textarea>
            </div>

            <!-- Description-->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-600">Brief Description</label>
                <textarea id="description" name="description" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">{{ $job->description }}</textarea>
            </div>

            <!-- Job_Description-->
            <div class="mb-4">
                <label for="job_description" class="block text-sm font-medium text-gray-600">Job Description</label>
                <textarea id="job_description" name="job_description" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500 resize-y" style="height: 200px;">{{ $job->job_description }}</textarea>
            </div>

            <!-- Job_Requirements-->
            <div class="mb-4">
                <label for="job_requirement" class="block text-sm font-medium text-gray-600">Job Requirement</label>
                <textarea id="job_requirement" name="job_requirement" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500 resize-y" style="height: 200px;">{{ $job->job_requirement }}</textarea>
            </div>
            

            <!-- Job_Category-->
            <div class="mb-4">
                <label for="job_category" class="block text-sm font-medium text-gray-600">Job Category</label>
                <textarea id="job_category" name="job_category" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">{{ $job->job_category }}</textarea>
            </div>

             <!-- Posted Date-->
             <div class="mb-4">
                <label for="posted_date" class="block text-sm font-medium text-gray-600">Posted Date</label>
                <textarea id="posted_date" name="posted_date" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">{{ $job->posted_date }}</textarea>
            </div>

             <!--LOGO-->
             <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-600">Change Logo </label>
                <br>
                <img src="{{ asset($job->logo) }}" alt="{{ $job->title }} Logo" class="w-full h-32 object-cover mb-4">
                <input type="file" id="logo" name="logo" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
            </div>


            <!-- Submit Button -->
            <button type="submit" class="bg-blue-500 text-white p-2 rounded w-full hover:bg-blue-600 focus:outline-none" name="getID" value="{{$job->job_id}}">
                Update
            </button>
        </form>
       
    </div>
</div>
@endsection
