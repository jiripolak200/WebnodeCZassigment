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
        <h2> DETAIL OBJEDNÁVEK </h2>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID objednávky</th>
                    <th>název</th>
                    <th>množství</th>
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

    $sql = "SELECT * FROM order_items ORDER BY id ASC";
    $result = $connection->query($sql);

    if (!$result) {
        die ("Invalid query: " . $connection->error);
    }

    $counter = 1;
    while ($row = $result->fetch_assoc()) {
        echo "
        <tr>
        <td>{$counter}</td>
        <td>{$row['order_id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['amount']}</td>
        </tr>
        ";
        $counter++;
    }
    ?>

</body>
</html>