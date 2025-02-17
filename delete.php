<?php
if ( isset($_GET['id']) ) {
    $id = $_GET['id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "order_list";

    $connection = new mysqli($servername, $username, $password, $dbname);

    $sql = "DELETE FROM orders WHERE id = $id";
    $connection->query($sql);
}

header("Location: /pohovor/index.php");
exit;

?>