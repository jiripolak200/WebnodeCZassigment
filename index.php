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
        <h1> SEZNAM OBJEDNÁVEK </h1>
        <a class="btn-new-order" href="/pohovor/create.php" role="button">Nová objednávka</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>datum vytvoření</th>
                    <th>název</th>
                    <th>částka</th>
                    <th>měna</th>
                    <th>stav</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "order_list";

                $connection = new mysqli($servername, $username, $password, $dbname);

                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                $sql = "SELECT * FROM orders ORDER BY id ASC";
                $result = $connection->query($sql);

                if (!$result) {
                    die ("Invalid query: " . $connection->error);
                }

                $counter = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>{$counter}</td>
                    <td>{$row['created_at']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['total_amount']}</td>
                    <td>{$row['currency']}</td>
                    <td>{$row['status']}</td>
                    <td>
                        <a class='btn-edit' href='/pohovor/edit.php?id={$row['id']}'>Upravit</a>
                        <a class='btn-delete' href='/pohovor/delete.php?id={$row['id']}'>Smazat</a>
                    </td>
                </tr>
                    ";
                    $counter++;
                }

                ?>

                
            </tbody>
        </table>
    </div>

    <div class="order-detail">
        <a href="/pohovor/order_detail.php">Detail objednávky</a>
    </div>

</body>
</html>