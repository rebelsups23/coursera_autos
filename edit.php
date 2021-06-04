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

if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']) && isset($_POST['model']) && isset($_POST['autos_id'])) {
    $make = $_POST['make'];
    $year = $_POST['year'];
    $mileage = $_POST['mileage'];
    $model = $_POST['model'];
    $autos_id = $_POST['autos_id'];

    if ($make === '' || $year === '' || $model === '' || $mileage === '') {
        $_SESSION['error'] = 'All fields are required';
        header("Location: edit.php?autos_id=$autos_id");
        return;
    }
    if (is_numeric($year) && is_numeric($mileage)) {
        $query = 'UPDATE autos 
                    SET make = :make,
                    year = :yr, model = :mo, mileage = :mi
                    WHERE autos_id = :autos_id';
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':make' => $make,
            ':yr' => $year,
            ':mo' => $model,
            ':mi' => $mileage,
            ':autos_id' => $autos_id
        ));

        $_SESSION['success'] = "Record edited";
        header("Location: index.php");
        return;
    } else {
        $_SESSION['error'] = 'Mileage and year must be numeric';
        header("Location: edit.php?autos_id=$autos_id");
        return;
    }
}

$stmt = $pdo->prepare("SELECT * FROM autos where autos_id = :aid");
$stmt->execute(array(":aid" => $_GET['autos_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false) {
    $_SESSION['error'] = 'Bad value for autos_id';
    header('Location: index.php');
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
        <div class="mt-5 bg-white shadow-xl max-w-screen-md mx-auto rounded p-5">
            <div class="flex mb-10">
                <h3 class="text-5xl flex-1 font-medium">Edit auto</h3>
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
            <form action="edit.php" method="POST" class="space-y-5 mt-5">
                <input type="text" class="w-full h-12 border border-gray-800 rounded px-3" name="make" placeholder="Make" value="<?= htmlentities($row['make']) ?>" />
                <input class="w-full h-12 border border-gray-800 rounded px-3" name="year" placeholder="Year" value="<?= htmlentities($row['year']) ?>" />
                <input class="w-full h-12 border border-gray-800 rounded px-3" name="model" placeholder="Model" value="<?= htmlentities($row['model']) ?>" />
                <input class="w-full h-12 border border-gray-800 rounded px-3" name="mileage" placeholder="Mileage" value="<?= htmlentities($row['mileage']) ?>" />
                <input type="hidden" name="autos_id" value="<?= $row['autos_id'] ?>">
                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Save</button>
            </form>
        </div>
    </div>
</body>

</html>