<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "order_list";

$connection = new mysqli($servername, $username, $password, $dbname);

$id = "";
$created_at = "";
$name = "";
$total_amount = "";
$currency = "";
$status = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET["id"])) {
        header("Location: /pohovor/index.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM orders WHERE id = $id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: /pohovor/index.php");
        exit;
    }

    $name = $row["name"];
    $total_amount = $row["total_amount"];
    $currency = $row["currency"];
    $status = $row["status"];
} else {
    $id = $_POST["id"];
    $created_at = $_POST["created_at"];
    $name = $_POST["name"];
    $total_amount = $_POST["total_amount"];
    $currency = $_POST["currency"];
    $status = $_POST["status"];

    do {
        if (empty($name) || empty($total_amount) || empty($currency) || empty($status)) {
            $errorMessage = "Všechna pole jsou povinná";
            break;
        }

        $sql = "UPDATE orders "
            . "SET name = '$name', total_amount = '$total_amount', currency = '$currency', status = '$status' "
            . "WHERE id = $id";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Něco se pokazilo: " . $connection->error;
            break;
        }

        $successMessage = "Objednávka byla úspěšně upravena";

        header("Location: /pohovor/index.php");
        exit;

    } while (false);
}

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Goldman&family=Liter&family=Londrina+Shadow&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Oswald:wght@200..700&family=Teko:wght@300..700&display=swap" rel="stylesheet">
    <title>PHP úkol</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container">
        <h2> Upravit objednávku </h2>

        <?php
        if (!empty($errorMessage)) {
            echo "<div class='alert alert-danger' role='alert'>$errorMessage</div>";
        }
        ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label class="new-form-label" for="name">Název</label>
                <div class="form-input">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="new-form-label" for="total_amount">Částka</label>
                <div class="form-input">
                    <input type="text" class="form-control" name="total_amount" value="<?php echo $total_amount; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="new-form-label" for="currency">Měna</label>
                <div class="form-input">
                    <input type="text" class="form-control" name="currency" value="<?php echo $currency; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="new-form-label" for="status">Stav</label>
                <div class="form-input">
                    <input type="text" class="form-control" name="status" value="<?php echo $status; ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "<div class='alert alert-success' role='alert'>$successMessage</div>";
            }
            ?>

            <div class="submit-btn">
                <button type="submit" class="btn btn-primary">Upravit</button>
            </div>
            <div class="cancel-btn">
                <a class="btn btn-outline-primary" href="/pohovor/index.php" role="button">Zrušit</a>
            </div>
        </form>
    </div>

</body>
</html>
