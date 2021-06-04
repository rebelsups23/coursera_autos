<?php 
session_start();
if (isset($_SESSION['name'])) {
    include 'view.php';
    return;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Suprav Kandel</title>
</head>

<body>
    <div class="mt-20 max-w-screen-lg mx-auto">
        <h1 class="text-3xl">Hey there!</h1>
        <h2 class="mt-2 mb-10 text-base">Welcome to AUTOS database</h2>
        <a class="text-blue-500" href="login.php">Please log in</a>

        <p class="mt-10">
            Can you view data of <a class="text-blue-500" href="view.php">autos</a> database without logging in? Give it a
            try.
        </p>
        <p class="mt-2">
            Can you add data to <a class="text-blue-500" href="add.php">autos</a> database without logging in? Give it a
            try.
        </p>
    </div>
</body>

</html>