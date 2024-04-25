@extends('layout')
@section('content')

<div class="mt-15"></div> <!-- Adding 15 pixels gap -->

<div class="flex justify-center items-center">

    <div class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        
        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
               <strong class="font-bold">Error!</strong>
               <span class="block sm:inline">{{ session('error') }}</span>
        </div>
       @endif

        <!-- Check if there is a success message in the session -->
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
       @endif
       
        <h1 class="text-2xl font-bold mb-4">Profile Information</h1>

        <!-- Profile Information Form -->
        <div class="flex justify-center mb-4">
            <img src="{{$pp}}" alt="" class="w-32 h-32 object-cover rounded-full border-4 border-white">
            <form action="/uploadX" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="ml-4">
                    <label for="description" class="block text-sm font-medium text-gray-600">Upload Profile Picture</label>
                    <input type="file" id="profilepic" name="profilepic" class="mt-1 p-2 border rounded-md focus:outline-none focus:border-blue-500">
                </div>
                <button type="submit" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none">Upload Picture</button>
            </form>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="name">Name:</label>
            <p class="text-gray-900">{{$user}}</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="id">ID:</label>
            <p class="text-gray-900">{{$id}}</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="cv">Current CV:</label>
            @if ($cv)
            <p>{{ pathinfo($cv, PATHINFO_FILENAME) }}</p>
            @else
            <p class="text-red-500">No CV uploaded</p>
            @endif
        </div>

        <div class="mb-4">
            <form action="/updatecv" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="resume">Upload a new CV:</label>
                    <input type="file" name="resume" accept=".pdf" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline">Update CV</button>
            </form>
        </div>

        <div>
            <form action="/changepassword" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="resume">Change Password</label>
                    <input type="text" placeholder="Enter Current Password" name="oldpass" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-5" >
                    <input type="text" placeholder="Enter New Password" name="newpass" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline">Change Password</button>
            </form>
        </div>
    </div>
</div>

<div class="mt-15"></div> <!-- Adding 15 pixels gap -->

<div class="bg-white mx-auto p-6 rounded-lg shadow-lg ">
    <h2 class="text-xl font-bold mb-4 flex justify-center items-center">Applied Jobs</h2>
    <div class="overflow-x-auto flex justify-center items-center">
        <table class="table-auto border-collapse border border-gray-400 ">
            <thead>
                <tr>
                    <th class="border border-gray-400 px-4 py-2">Name</th>
                    <th class="border border-gray-400 px-4 py-2">User ID</th>
                    <th class="border border-gray-400 px-4 py-2">User Email</th>
                    <th class="border border-gray-400 px-4 py-2">Applied Job ID</th>
                    <th class="border border-gray-400 px-4 py-2">Job Title</th>
                    <th class="border border-gray-400 px-4 py-2">Company Name</th>
                    <th class="border border-gray-400 px-4 py-2">Applied Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                <tr>
                    <td class="border border-gray-400 px-4 py-2">{{ $record->client_name }}</td>
                    <td class="border border-gray-400 px-4 py-2">{{ $record->client_id }}</td>
                    <td class="border border-gray-400 px-4 py-2">{{ $record->client_email }}</td>
                    <td class="border border-gray-400 px-4 py-2">{{ $record->job_id }}</td>
                    <td class="border border-gray-400 px-4 py-2">{{ $record->job_title }}</td>
                    <td class="border border-gray-400 px-4 py-2">{{ $record->company_name }}</td>
                    <td class="border border-gray-400 px-4 py-2">{{ $record->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
