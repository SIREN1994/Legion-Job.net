@extends('layout')

@section('content')

@if(auth()->check())
@php
$name = session()->get('user')['name'] ?? 'User';    
$client = \App\Models\Client::where('name', $name)->first();
$resume = $client ? $client->resume : null;
@endphp


@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<div class="flex">
    <!-- Main Content -->
    <div class="w-3/4 p-4">
        @foreach ($jobs as $job)
        <div class="mb-8 border-2 border-gray-300 rounded-lg shadow-lg p-6 bg-gradient-to-br from-yellow-300 to-yellow-500">
            <div class="flex flex-col items-start justify-between mb-4">
                <div class="flex items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 text-black-500 bg-red-600 rounded-full p-2 mr-4">
                        <path fill-rule="evenodd" d="M9 4.5a.75.75 0 0 1 .721.544l.813 2.846a3.75 3.75 0 0 0 2.576 2.576l2.846.813a.75.75 0 0 1 0 1.442l-2.846.813a3.75 3.75 0 0 0-2.576 2.576l-.813 2.846a.75.75 0 0 1-1.442 0l-.813-2.846a3.75 3.75 0 0 0-2.576-2.576l-2.846-.813a.75.75 0 0 1 0-1.442l2.846-.813A3.75 3.75 0 0 0 7.466 7.89l.813-2.846A.75.75 0 0 1 9 4.5ZM18 1.5a.75.75 0 0 1 .728.568l.258 1.036c.236.94.97 1.674 1.91 1.91l1.036.258a.75.75 0 0 1 0 1.456l-1.036.258c-.94.236-1.674.97-1.91 1.91l-.258 1.036a.75.75 0 0 1-1.456 0l-.258-1.036a2.625 2.625 0 0 0-1.91-1.91l-1.036-.258a.75.75 0 0 1 0-1.456l1.036-.258a2.625 2.625 0 0 0 1.91-1.91l.258-1.036A.75.75 0 0 1 18 1.5ZM16.5 15a.75.75 0 0 1 .712.513l.394 1.183c.15.447.5.799.948.948l1.183.395a.75.75 0 0 1 0 1.422l-1.183.395c-.447.15-.799.5-.948.948l-.395 1.183a.75.75 0 0 1-1.422 0l-.395-1.183a1.5 1.5 0 0 0-.948-.948l-1.183-.395a.75.75 0 0 1 0-1.422l1.183-.395c.447-.15.799-.5.948-.948l.395-1.183A.75.75 0 0 1 16.5 15Z" clip-rule="evenodd" />
                    </svg>
                    <h2 class="text-2xl font-semibold text-black">Vacant Position: {{$job->title}}</h2>
                </div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 text-black-500 bg-red-600 rounded-full p-2 mr-4">
                        <path fill-rule="evenodd" d="M4.5 2.25a.75.75 0 0 0 0 1.5v16.5h-.75a.75.75 0 0 0 0 1.5h16.5a.75.75 0 0 0 0-1.5h-.75V3.75a.75.75 0 0 0 0-1.5h-15ZM9 6a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H9Zm-.75 3.75A.75.75 0 0 1 9 9h1.5a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM9 12a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H9Zm3.75-5.25A.75.75 0 0 1 13.5 6H15a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75ZM13.5 9a.75.75 0 0 0 0 1.5H15A.75.75 0 0 0 15 9h-1.5Zm-.75 3.75a.75.75 0 0 1 .75-.75H15a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75ZM9 19.5v-2.25a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75h-4.5A.75.75 0 0 1 9 19.5Z" clip-rule="evenodd" />
                    </svg>                     
                    <h2 class="text-xl font-semibold text-black">Hiring Company: {{$job->company}}</h2>
                </div>
            </div>
            
            <div class="flex justify-center mb-4">
                <img src="{{$job->logo}}" alt="{{$job->company}}" class="w-32 h-32 object-cover rounded-full border-4 border-white">
            </div>
            <p class="text-lg font-semibold mb-4">{{$job->description}}</p>
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Job Description</h2>
                <ul class="list-disc ml-6">
                    @php
                        $requirements = explode(',', $job->job_description);
                    @endphp
                    @foreach($requirements as $requirement)
                        <li>{{ trim($requirement) }}</li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h2 class="text-xl font-semibold mb-2">Job Requirements</h2>
                <ul class="list-disc ml-6">
                    @php
                        $requirements = explode(',', $job->job_requirement);
                    @endphp
                    @foreach($requirements as $requirement)
                        <li>{{ trim($requirement) }}</li>

                    @endforeach
                </ul>
                <br>
                <p class="text-lg font-semibold mb-4">Offical Website : <a  style="color: blue" href="{{$job->website}}">{{$job->website}}</a></p>
            </div>
        </div>
        
        @endforeach
    </div>


    <div>
        <div class="mt-8">
            <h2 class="text-lg font-semibold mb-4">Logged in as: {{$name}}</h2>
            
        </div>
        
        @if($resume)
        <div class="mt-4">
            <h2 class="text-lg font-semibold mb-2">Resume:</h2>
            <h2>Current CV : {{pathinfo($resume, PATHINFO_FILENAME)}}</h2>
            <form action="/applyjob" method="POST">
                @csrf
                <button name="getID" value="{{$job->job_id}}" class="bg-blue-500 text-white p-2 rounded w-full hover:bg-blue-600 focus:outline-none">Apply This Job</button>
            </form>
        </div>

        <div class="mt-4">
            <form action="/updatecv" method="POST" enctype="multipart/form-data">
                @csrf
               <input type="file" name="resume" accept=".pdf" class="mb-2">
               <button type="submit" class="bg-red-500 text-white p-2 rounded w-full hover:bg-blue-600 focus:outline-none">Update A New Resume</button>
           </form>
        </div>
        @else

        <!-- Get current session username and upload a cv at it's row at Client Model, 
                    then redirect the page with intened method, you will have to make a job applied record table first 
                    then prevent the current user to apply the same job twice!
                    This website will complete it's sturcture after I made applied cv was sent to admin site with client and applied job
                    paired the actual PDF or Words File-->
        
            
        <form action="/updatecv" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="resume">Upload a new CV:</label>
                    <input type="file" name="resume" accept=".pdf" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline">Update CV</button>
        </form>      
        @endif
    </div>
</div>

@else
<div class="flex">
    <!-- Main Content -->
    <div class="w-3/4 p-4">
        @foreach ($jobs as $job)
        <div class="mb-8 border-2 border-gray-300 rounded-lg shadow-lg p-6 bg-gradient-to-br from-yellow-300 to-yellow-500">
            <div class="flex flex-col items-start justify-between mb-4  "> <!-- Add class and background style here -->
                <div class="flex items-center bg-white rounded-lg shadow-lg p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375Zm9.586 4.594a.75.75 0 0 0-1.172-.938l-2.476 3.096-.908-.907a.75.75 0 0 0-1.06 1.06l1.5 1.5a.75.75 0 0 0 1.116-.062l3-3.75Z" clip-rule="evenodd" />
                    </svg>                      
                    <h2 class="text-2xl font-semibold text-black">Vacant Position: {{$job->title}}</h2>
                </div>
                <br>
                <div class="flex items-center bg-white rounded-lg shadow-lg p-4"> <!-- Add class and background style here -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M4.5 2.25a.75.75 0 0 0 0 1.5v16.5h-.75a.75.75 0 0 0 0 1.5h16.5a.75.75 0 0 0 0-1.5h-.75V3.75a.75.75 0 0 0 0-1.5h-15ZM9 6a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H9Zm-.75 3.75A.75.75 0 0 1 9 9h1.5a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM9 12a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H9Zm3.75-5.25A.75.75 0 0 1 13.5 6H15a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75ZM13.5 9a.75.75 0 0 0 0 1.5H15A.75.75 0 0 0 15 9h-1.5Zm-.75 3.75a.75.75 0 0 1 .75-.75H15a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75ZM9 19.5v-2.25a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75h-4.5A.75.75 0 0 1 9 19.5Z" clip-rule="evenodd" />
                    </svg>
                        
                    <h2 class="text-xl font-semibold text-black">Hiring Company: {{$job->company}}</h2>
                </div>
            </div>
            
            <div class="flex justify-center mb-4">
                <img src="{{$job->logo}}" alt="{{$job->company}}" class="w-32 h-32 object-cover rounded-full border-4 border-white">
            </div>
            <p class="text-lg font-semibold mb-4">{{$job->description}}</p>
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Job Description</h2>
                <ul class="list-disc ml-6">
                    @php
                        $requirements = explode(',', $job->job_description);
                    @endphp
                    @foreach($requirements as $requirement)
                        <li>{{ trim($requirement) }}</li>
                    @endforeach
                </ul>
                
            </div>
            <div>
                <h2 class="text-xl font-semibold mb-2">Job Requirements</h2>
                <ul class="list-disc ml-6">
                    @php
                        $requirements = explode(',', $job->job_requirement);
                    @endphp
                    @foreach($requirements as $requirement)
                        <li>{{ trim($requirement) }}</li>
                    @endforeach
                </ul>
                <br>
                <p class="text-lg font-semibold mb-4">Official Website : <a  style="color: blue" href="{{$job->website}}">{{$job->website}}</a></p>
            </div>
        </div>
        
        @endforeach
    </div>


    <!-- Sidebar -->
    <div class="w-1/4 p-4 bg-gray-200">
        <div>
            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Oops! Something went wrong.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <h2 class="text-lg font-semibold mb-4">Log In To Apply Job</h2>
            <form action="/loginX" method="POST">
                @csrf
                <input type="hidden" name="getID" value="{{ $job->job_id }}">
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="mt-1 p-2 block w-full rounded-md bg-white border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="mt-1 p-2 block w-full rounded-md bg-white border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50">Log In</button>
            </form>
        </div>    
    </div>
</div>
@endif

@endsection
