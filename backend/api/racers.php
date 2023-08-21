<?php
require_once "../connection.php";

include_once "../controllers/racerController.php";

switch ($_SERVER["REQUEST_METHOD"]) {
    case 'GET':
        if (isset($_GET['search'])) {
            $searchText = $_GET['search'];
            $raceController = RacerController::getInstance($connection);

            $racers = $raceController->searchRacers($searchText);

            echo json_encode($racers);
        } else {
            $raceController = RacerController::getInstance($connection);
            $racers = $raceController->getRacers();

            echo json_encode($racers);
        }
        break;

    case 'POST':
        # code...
        break;

    case 'PUT':
        # code...
        break;

    case 'DELETE':
        # code...
        break;
}
