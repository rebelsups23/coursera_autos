<?php 
    $errors = [];
    if (isset($_POST['who']) && isset($_POST['who'])) {
        $email = trim($_POST['who']);
        $password = trim($_POST['pass']);
        if ($email == "" || $password == "" ) {
            array_push($errors , "Email and password are required.");
        } elseif (strpos($email, "@") === false) {
            array_push($errors , "Email needs to have '@' sign.");
        } elseif (hash('md5',$password) !== "218140990315bb39d948a523d61549b4") {
            array_push($errors, "Incorrect password");
            $check = hash('md5',$password);
            error_log("Login fail $email $check");
        } else {
            error_log("Login success $email");
            header("Location: autos.php?name=".urlencode($_POST['email']));
        }
    }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Suprav Kandel | Login</title>
</head>

<body>
    <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
        <div class="bg-white w-96 shadow-xl rounded p-5">
            <h1 class="text-3xl font-medium">Welcome</h1>
            <p class="text-sm mb-5">Please login to continue</p>
            <?php 
                if ($errors) {
                    $lastIdx = sizeof($errors)-1;
                    echo "
                        <div class='my-4 text-red-600 border text-center py-3 text-sm'>
                            $errors[$lastIdx]
                        </div>
                    ";
                }
            ?>
            <form action="login.php" method="POST" class="space-y-5 mt-5">
                <input type="text" class="w-full h-12 border border-gray-800 rounded px-3" name="who"
                    placeholder="Email" />
                <input class="w-full h-12 border border-gray-800 rounded px-3" name="pass" placeholder="Password" />
                <button type="submit"
                    class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Please Log In</button>
            </form>
        </div>
    </div>
</body>

</html>