<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Book app</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col justify-between items-center h-screen">
    <x-navbar />

    <main>
        <h1>this is the homepage</h1>

    </main>

    <x-footer />
</body>

</html>