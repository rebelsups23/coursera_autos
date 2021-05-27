<?php
session_start();
if (!isset($_SESSION['name'])) {
    die('Not logged in');
}

require_once "pdo.php";

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
        <div class="mt-5 bg-white shadow-xl rounded p-5">
            <div class="mt-20">
                <h4 class="text-3xl mb-3">Tracking autos for <?php echo $_SESSION['name'] ?></h4>
                <ul class="list-disc list-inside">
                    <?php
                    if (isset($_SESSION['success'])) {
                        echo ('<div class="my-4 text-green-600 border text-center py-3 text-sm">' . htmlentities($_SESSION['success']) . "</div>\n");
                        unset($_SESSION['success']);
                    }

                    $stmt = $pdo->query("SELECT * FROM autos ORDER BY make asc");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<li>' . $row['year'] . ' ' . htmlentities($row['make']) . ' / ' . $row['mileage'] . '</li>';
                    }
                    ?>
                </ul>
            </div>
            <div class="flex mt-10">
                    <a href="add.php" class="bg-green-400 px-5 py-2 text-white rounded inline-block mr-2">Add New</a>
                    <a href="logout.php" name="logout" class="bg-red-400 px-5 py-2 text-white rounded">Logout</a>
            </div>
        </div>
</body>

</html>