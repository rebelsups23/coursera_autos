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
if ( isset($_POST['delete']) && isset($_POST['autos_id']) ) {
    $sql = "DELETE FROM autos WHERE autos_id = :aid";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':aid' => $_POST['autos_id']));
    $_SESSION['success'] = 'Record deleted';
    header( 'Location: index.php' ) ;
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
            <h5 class="text-4xl">Are you sure?</h5>
            <form action="delete.php" method="POST" class="space-y-5 mt-5">
                <input type="hidden" name="autos_id" value="<?= $_GET['autos_id'] ?>">
                <button class="px-4 py-2 bg-red-600 text-white mr-2" type="submit" name="delete">Delete</button>
                <button class="px-4 py-2 bg-gray-200" type="submit" name="cancel">Cancel</button>
            </form>
        </div>
    </div>
</body>

</html>