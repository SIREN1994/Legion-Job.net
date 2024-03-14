@extends('Admin.adminpanel')
@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-semibold mb-6">Register</h2>

        
         <!-- Check if there are validation errors -->
         @if($errors->any())
         <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
             <strong class="font-bold">Validation Error!</strong>
             <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
             </ul>
         </div>
     @endif

         <!-- Check if there is a success message in the session -->
         @if(session('success'))
         <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
             <strong class="font-bold">Success!</strong>
             <span class="block sm:inline">{{ session('success') }}</span>
         </div>
        @endif

        <!-- Registration Form -->
        <form action="/addjobs" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Job Title -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-600">Job Title</label>
                <input type="text" id="title" name="title" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <!-- Job Tags -->
            <div class="mb-4">
                <label for="tags" class="block text-sm font-medium text-gray-600">Tags</label>
                <input type="text" id="tags" name="tags" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <!-- Company -->
            <div class="mb-6">
                <label for="company" class="block text-sm font-medium text-gray-600">Hiring Company</label>
                <input type="text" id="company" name="company" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
            </div>

             <!-- Location -->
             <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-600">Location</label>
                <input type="text" id="location" name="location" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
            </div>

             <!-- Email -->
             <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                <input type="text" id="email" name="email" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
            </div>

             <!-- Website -->
             <div class="mb-4">
                <label for="website" class="block text-sm font-medium text-gray-600">Website</label>
                <input type="text" id="website" name="website" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <!-- Description-->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-600">Brief Description</label>
                <textarea id="description" name="description" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500"></textarea>
            </div>

             <!-- Detail Description-->
             <div class="mb-4">
                <label for="job_description" class="block text-sm font-medium text-gray-600">Job Description</label>
                <input type="text" id="job_description" name="job_description" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500 resize-y" style="height: 200px;">
            </div>

             <!-- Job Requirement-->
             <div class="mb-4">
                <label for="job_requirement" class="block text-sm font-medium text-gray-600">Job Requirements</label>
                <input type="text" id="job_requirement" name="job_requirement" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500 resize-y" style="height: 200px;">
            </div>

           <!-- Job Category -->
            <div class="mb-4">
                <label for="job_category" class="block text-sm font-medium text-gray-600">Job Category</label>

                <div class="mt-1 grid grid-cols-2 gap-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="job_category" value="Sale" class="form-radio text-blue-500 focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <span class="ml-2">Sale</span>
                    </label>

                    <label class="inline-flex items-center">
                        <input type="radio" name="job_category" value="Marketing" class="form-radio text-blue-500 focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <span class="ml-2">Marketing</span>
                    </label>

                    <label class="inline-flex items-center">
                        <input type="radio" name="job_category" value="Human Resource" class="form-radio text-blue-500 focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <span class="ml-2">Human Resource</span>
                    </label>

                    <label class="inline-flex items-center">
                        <input type="radio" name="job_category" value="Accounting" class="form-radio text-blue-500 focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <span class="ml-2">Accounting</span>
                    </label>

                    <label class="inline-flex items-center">
                        <input type="radio" name="job_category" value="Finance" class="form-radio text-blue-500 focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <span class="ml-2">Finance</span>
                    </label>

                    <label class="inline-flex items-center">
                        <input type="radio" name="job_category" value="Creative and Art" class="form-radio text-blue-500 focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <span class="ml-2">Creative and Art</span>
                    </label>
                </div>
            </div>


            <!-- Posted Date-->
            <div class="mb-4">
                <label for="posted_date" class="block text-sm font-medium text-gray-600">Posted Date</label>
                <textarea id="posted_date" name="posted_date" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500"></textarea>
            </div>

            <!-- LOGO -->
            <div class="mb-4">
                <label for="logo" class="block text-sm font-medium text-gray-600">Add Logo</label>
                <input type="file" id="logo" name="logo" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-500 text-white p-2 rounded w-full hover:bg-blue-600 focus:outline-none">
                Register
            </button>
        </form>
    </div>
</div>
@endsection