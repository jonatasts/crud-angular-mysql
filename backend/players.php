<?php

require_once "./connection.php";

$searchText = $_GET['search'];
$customers = [];

$result = mysqli_query(
    $connection,
    "SELECT * 
     FROM player
     WHERE CONCAT(name, wins, years)
     LIKE '%" . $searchText . "%'"
);

while ($customer = mysqli_fetch_assoc($result)) {
    array_push($customers, $customer);
}

echo json_encode($customers);

