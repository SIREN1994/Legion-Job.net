
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
    
    
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <header class="bg-blue-500 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/">
            <!-- Logo on the left -->
            <div class="flex items-center">
                <!-- Replace 'your-logo.png' with your actual logo file -->
                    <img src="/Golden Legion.png" alt="Logo" class="h-20 w-15 mr-2">
                    <span class="text-white text-lg font-semibold">LEGION Jobs.net</span>               
            </div>
            </a>
            <!-- Navigation tabs on the right -->
            <nav class="flex items-center space-x-4">
                <!-- Home tab with home icon -->
                

                <!-- Search Companies -->
                <div x-data="{ dropdownOpen: false }" class="relative">
                    <div @click="dropdownOpen = !dropdownOpen" class="text-white flex items-center cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M3 2.25a.75.75 0 0 0 0 1.5v16.5h-.75a.75.75 0 0 0 0 1.5H15v-18a.75.75 0 0 0 0-1.5H3ZM6.75 19.5v-2.25a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75h-3a.75.75 0 0 1-.75-.75ZM6 6.75A.75.75 0 0 1 6.75 6h.75a.75.75 0 0 1 0 1.5h-.75A.75.75 0 0 1 6 6.75ZM6.75 9a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75ZM6 12.75a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 0 1.5h-.75a.75.75 0 0 1-.75-.75ZM10.5 6a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75Zm-.75 3.75A.75.75 0 0 1 10.5 9h.75a.75.75 0 0 1 0 1.5h-.75a.75.75 0 0 1-.75-.75ZM10.5 12a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75ZM16.5 6.75v15h5.25a.75.75 0 0 0 0-1.5H21v-12a.75.75 0 0 0 0-1.5h-4.5Zm1.5 4.5a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Zm.75 2.25a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75v-.008a.75.75 0 0 0-.75-.75h-.008ZM18 17.25a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Z" clip-rule="evenodd" />
                        </svg>
                        All Companies
                    </div>
                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="dropdown1 absolute top-10 right-0 bg-white shadow-md rounded-md">
                        <ul>
                            @foreach ($companies as $company)
                                <li><a href="/company/{{$company->company}}" class="block px-4 py-2 hover:bg-gray-700 cursor-pointer">{{$company->company}}</a></li>   
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
                
                
                <!-- Search Category -->
                <div x-data="{ dropdownOpen: false }" class="relative">
                    <div class="text-white flex items-center cursor-pointer" @click="dropdownOpen = !dropdownOpen">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path d="M7.5 3.375c0-1.036.84-1.875 1.875-1.875h.375a3.75 3.75 0 0 1 3.75 3.75v1.875C13.5 8.161 14.34 9 15.375 9h1.875A3.75 3.75 0 0 1 21 12.75v3.375C21 17.16 20.16 18 19.125 18h-9.75A1.875 1.875 0 0 1 7.5 16.125V3.375Z" />
                            <path d="M15 5.25a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963A5.23 5.23 0 0 0 17.25 7.5h-1.875A.375.375 0 0 1 15 7.125V5.25ZM4.875 6H6v10.125A3.375 3.375 0 0 0 9.375 19.5H16.5v1.125c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V7.875C3 6.839 3.84 6 4.875 6Z" />
                        </svg>
                                            
                        Jobs Category
                    </div>                    
                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="dropdown1 absolute top-10 right-0 bg-white shadow-md rounded-md">
                        <ul>
                            @foreach ($categories as $category)
                                <li><a href="/category/{{$category->job_category}}" class="block px-4 py-2 hover:bg-gray-700 cursor-pointer">{{$category->job_category}}</a></li>   
                            @endforeach
                        </ul>
                    </div>
                </div>

                
                <!-- View Profile -->
                <div class="flex items-center">
                    <a href="/viewprofile" class="text-white flex items-center">
                        <img src="{{$pfp}}" alt="Profile Picture" class="w-16 h-16 object-cover rounded-full border-4 border-white mr-2">
                        <div>
                            <p class="text-white font-bold">User: {{$userName}}</p>
                            <p class="text-white font-bold">ID: {{$userId}}</p>
                        </div>
                    </a>
                </div>


                <!-- Logout -->
                <a href="/logout" class="text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                      </svg>                                                                
                    Logout
                </a>

                
            </nav>
        </div>
    </header>

    <!-- Your page content goes here -->

</body>
</html>
