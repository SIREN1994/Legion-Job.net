<?php
use App\Models\Client; // Add this line to declare the usage of the Client model

// Check if the user is authenticated
$user = auth()->user();

// If authenticated, use auth()->user() data
if ($user) {
    $userName = $user->name;
    $userId = $user->client_id;
    $pfp = Client::where('client_id', $user->client_id)->value('profilepic');

    // Check if profile picture is null, assign default URL
    if (!$pfp) {
        $pfp = "https://static.vecteezy.com/system/resources/previews/029/825/357/original/default-avatar-profile-icon-isolated-on-white-background-social-media-user-sign-symbol-vector.jpg";
    }
} else {
    // If not authenticated, use session data (if it exists)
    $sessionUser = session()->get('user', null);

    // Check if session data exists and retrieve user name and ID
    if ($sessionUser) {
        $userName = $sessionUser['name'];
        $userId = $sessionUser['client_id'];
        $pfp = Client::where('client_id', $userId)->value('profilepic');

        // Check if profile picture is null, assign default URL
        if (!$pfp) {
            $pfp = "https://static.vecteezy.com/system/resources/previews/029/825/357/original/default-avatar-profile-icon-isolated-on-white-background-social-media-user-sign-symbol-vector.jpg";
        }
    } else {
        // Set default values or an empty state for non-authenticated users
        $userName = 'Guest';
        $userId = "00000";
        $pfp = "https://static.vecteezy.com/system/resources/previews/029/825/357/original/default-avatar-profile-icon-isolated-on-white-background-social-media-user-sign-symbol-vector.jpg";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel</title>
    <link rel="icon" href="Legion Icon.png" type="image/x-icon">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Alpine.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</head>

<body class="font-sans bg-gray-100">

    <!-- Header -->
    <header class="bg-gray-500 shadow-md p-2">
        <div class="flex items-center justify-between bg-gray-800 p-4">
            <!-- Logo and Site Name -->
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <img src="/Golden Legion.png" alt="Logo" class="h-20 w-15 mr-2">
                    <span class="text-lg font-semibold text-white">Admin Site</span>
                </div>
            </div>
        
            <!-- Logged-in User Profile -->
            <div class="flex items-center space-x-4">
                <div class="flex items-center text-white space-x-2">
                    <div class="flex items-center space-x-4">
                        <p class="font-semibold">{{$userName}}</p>
                        <form action="/adminlogout" method="POST">
                            @csrf
                            <button class="text-white hover:text-gray-300">Log Out</button>
                        </form>
                    </div>
                    <img src="{{$pfp}}" alt="Profile Picture" class="w-16 h-16 object-cover rounded-full border-4 border-white">
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <div class="flex">
        <!-- Sidebar -->
            
    
        <aside class="bg-gray-800 text-white w-64 min-h-screen ">
            <div class="p-4 text-2xl font-semibold">Admin Panel</div>
            <nav class="text-white">
                <ul class="p-2">
                    <li class="mb-2"><a href="/overview" class="block px-4 py-2 hover:bg-gray-700">Admin Overview</a></li>
                    <li class="mb-2"><a href="/applicants" class="block px-4 py-2 hover:bg-gray-700">Job Applications Page</a></li>
                    <li class="mb-2"><a href="/addjobs" class="block px-4 py-2 hover:bg-gray-700">Add New Jobs</a></li>
                    <li class="mb-2" x-data="{ isOpen: false }">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-700" @click="isOpen = !isOpen">Edit The Job Offers</a>
                        <ul x-show="isOpen" @click.away="isOpen = false" class="pl-4">
                            <!-- All Variables Came From Appservice Provider-->
                            <li><a href="/editjobs" class="block px-4 py-2 hover:bg-gray-700">All Jobs ({{$all}})</a></li>
                            <!-- Using show function from JobsController and web.php;s  /show/{value}url-->
                            <li><a href="/show/Sale" class="block px-4 py-2 hover:bg-gray-700">Sales({{$sale}})</a></li>
                            <li><a href="/show/Marketing" class="block px-4 py-2 hover:bg-gray-700">Marketing ({{$marketing}})</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Advertising ({{$advertising}})</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">HR ({{$HR}})</a></li>
                            <li><a href="/show/Finance" class="block px-4 py-2 hover:bg-gray-700">Finance ({{$finance}})</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Logistic (0)</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">IT ({{$IT}})</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Audit ({{$audit}})</a></li>
                            <li><a href="/show/Creative and Art" class="block px-4 py-2 hover:bg-gray-700">Creative & Art ({{$Art}})</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Public Relation (0)</a></li>
                            
                            
                            <!-- Search box -->
                            <li class="flex flex-col items-center space-y-2">
                                <form action="/search" method="GET" class="flex flex-col items-center space-y-2">
                                    @csrf
                                    <div class="flex items-center space-x-2">
                                        <input type="text" name="query" placeholder="Search..." class="border rounded p-2 focus:outline-none flex-grow text-black">
                                    </div>
                                    <div>
                                        <button type="submit" class="bg-blue-500 text-white px-4 rounded hover:bg-blue-600 focus:outline-none">Search</button>
                                    </div>
                                </form>
                            </li>
                      
                        </ul>
                    </li >
                    
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4">

            <!-- Add your main content here -->
            @yield('content')
    
        </main>
    </div>

</body>

</html>
