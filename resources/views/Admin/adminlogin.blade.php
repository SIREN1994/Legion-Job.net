<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin LogIn</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
   
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">


    <div class="bg-white p-8 rounded shadow-md w-96" >
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
        <h2 class="text-2xl font-semibold mb-4">Admin Login</h2>
        <form action="/adminlogin" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-600 text-sm font-semibold mb-2">Email</label>
                <input type="text" id="email" name="email" class="w-full border p-2 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-600 text-sm font-semibold mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full border p-2 rounded focus:outline-none focus:border-blue-500">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Login</button>
        </form>
    </div>
</body>
</html>