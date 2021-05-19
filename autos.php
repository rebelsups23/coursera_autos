<?php
    require_once "pdo.php";
    $msg = '';

    if (!isset($_GET['name'])) {
        die("Name parameter missing");
    }
    
    if (isset($_POST['logout'])) {
        header("Location: login.php");
    }
    if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {
        $make = htmlentities(trim($_POST['make']));
        $year = $_POST['year'];
        $mileage = $_POST['mileage'];

        if (is_numeric($year) && is_numeric($mileage)) {
            if ($make !== '') {
                $stmt = $pdo->prepare('INSERT INTO autos
                        (make, year, mileage) VALUES ( :mk, :yr, :mi)');
                $stmt->execute(
                    array(
                        ':mk' => $_POST['make'],
                        ':yr' => $_POST['year'],
                        ':mi' => $_POST['mileage']
                    )
                );

                $msg = 'Record inserted';
            } else {
                $msg = 'Make is required';
            }
        } else {
            $msg = 'Mileage and year must be numeric';
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
        <div class="mt-5 bg-white shadow-xl rounded p-5">
            <h3 class="text-2xl font-medium">Add a new auto</h3>
            <?php
            if ($msg) {
                if ($msg === 'Record inserted') {
                    echo "
                        <div class='my-4 text-green-600 border text-center py-3 text-sm'>
                            $msg
                        </div>
                    ";
                } else {
                    echo "
                        <div class='my-4 text-red-600 border text-center py-3 text-sm'>
                            $msg
                        </div>
                    ";
                }
            }
            ?>
            <form action="<?php echo ('autos.php?name=' . htmlentities($_GET['name'])) ?>" method="POST"
                class="space-y-5 mt-5">
                <input type="text" class="w-full h-12 border border-gray-800 rounded px-3" name="make"
                    placeholder="Make" />
                <input class="w-full h-12 border border-gray-800 rounded px-3" name="year" placeholder="Year" />
                <input class="w-full h-12 border border-gray-800 rounded px-3" name="mileage" placeholder="Mileage" />
                <button type="submit"
                    class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Add</button>
                <button type="submit" name="logout" class="bg-red-400 px-5 py-2 text-white rounded">logout</button>
            </form>
        </div>

        <div class="mt-20">
            <h4 class="text-2xl mb-3">Automobiles</h4>
            <ul class="list-disc list-inside">
                <?php
                $stmt = $pdo->query("SELECT * FROM autos ORDER BY make asc");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<li>' . $row['year'] . ' ' . htmlentities($row['make']) . ' / ' . $row['mileage'] . '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</body>

</html>