<?php
session_start();
if (!isset($_SESSION['name'])) {
    die('ACCESS DENIED');
}
if (isset($_POST['cancel'])) {
    header("Location: index.php");
    return;
}

require_once 'pdo.php';

if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']) && isset($_POST['model'])) {
    $make = $_POST['make'];
    $year = $_POST['year'];
    $mileage = $_POST['mileage'];
    $model = $_POST['model'];

    if ($make === '' || $year === '' || $model === '' || $mileage === '') {
        $_SESSION['error'] = 'All fields are required';
        header("Location: add.php");
        return;
    }
    if (is_numeric($year) && is_numeric($mileage)) {
        $stmt = $pdo->prepare('INSERT INTO autos
                    (make, year, model, mileage) VALUES ( :mk, :yr, :mo, :mi)');
        $stmt->execute(
            array(
                ':mk' => $make,
                ':yr' => $year,
                ':mo' => $model,
                ':mi' => $mileage,
            )
        );

        $_SESSION['success'] = "Record added";
        header("Location: index.php");
        return;
    } else {
        $_SESSION['error'] = 'Mileage and year must be numeric';
        header("Location: add.php");
        return;
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
    <title>Suprav Kandel</title>
</head>

<body>
    <div class="mt-20 max-w-screen-lg mx-auto">
        <div class="mt-5 bg-white shadow-xl max-w-screen-md mx-auto rounded p-5">
            <div class="flex mb-10">
                <h3 class="text-5xl flex-1 font-medium">Add a new auto</h3>
                <form action="add.php" method="POST">
                    <button type="submit" name="cancel" class="bg-red-400 px-5 py-2 text-white rounded">Cancel</button>
                </form>
            </div>
            <?php
            if (isset($_SESSION['error'])) {
                echo ('<div class="my-4 text-red-600 border text-center py-3 text-sm">' . htmlentities($_SESSION['error']) . "</div>\n");
                unset($_SESSION['error']);
            }
            ?>
            <form action="add.php" method="POST" class="space-y-5 mt-5">
                <input type="text" class="w-full h-12 border border-gray-800 rounded px-3" name="make" placeholder="Make" />
                <input class="w-full h-12 border border-gray-800 rounded px-3" name="year" placeholder="Year" />
                <input class="w-full h-12 border border-gray-800 rounded px-3" name="model" placeholder="Model" />
                <input class="w-full h-12 border border-gray-800 rounded px-3" name="mileage" placeholder="Mileage" />
                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Add</button>
            </form>
        </div>
    </div>
</body>

</html>