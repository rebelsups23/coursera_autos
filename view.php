<?php
if (!isset($_SESSION['name'])) {
    die('ACCESS DENIED');
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
                <h4 class="text-3xl mb-10">Tracking autos for <?php echo $_SESSION['name'] ?></h4>
                <?php
                if (isset($_SESSION['success'])) {
                    echo ('<div class="my-4 text-green-800 border text-center py-3">' . htmlentities($_SESSION['success']) . "</div>\n");
                    unset($_SESSION['success']);
                }
                ?>
                <table class="border border-green-800">
                    <thead>
                        <tr>
                            <th class="border border-green-800 px-4 py-1 font-bold">
                                Make
                            </th>
                            <th class="border border-green-800 px-4 py-1 font-bold">
                                Year
                            </th>
                            <th class="border border-green-800 px-4 py-1 font-bold">
                                Model
                            </th>
                            <th class="border border-green-800 px-4 py-1 font-bold">
                                Mileage
                            </th>
                            <th class="border border-green-800 px-4 py-1 font-bold">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM autos ORDER BY make asc");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr><td class='border border-green-600 px-4 py-1'>";
                        echo (htmlentities($row['make']));
                        echo ("</td><td class='border border-green-600 px-4 py-1'>");
                        echo (htmlentities($row['year']));
                        echo ("</td><td class='border border-green-600 px-4 py-1'>");
                        echo (htmlentities($row['model']));
                        echo ("</td><td class='border border-green-600 px-4 py-1'>");
                        echo (htmlentities($row['mileage']));
                        echo ("</td><td class='border border-green-600 px-4 py-1'>");
                        echo ('<a href="edit.php?autos_id=' . $row['autos_id'] . '">Edit</a> / ');
                        echo ('<a href="delete.php?autos_id=' . $row['autos_id'] . '">Delete</a>');
                        echo ("</td></tr>\n");
                    }
                    ?>
                </table>
            </div>
            <div class="flex mt-10">
                <a href="add.php" class="bg-green-400 px-5 py-2 text-white rounded inline-block mr-2">Add New Entry</a>
                <a href="logout.php" name="logout" class="bg-red-400 px-5 py-2 text-white rounded">Logout</a>
            </div>
        </div>
</body>

</html>