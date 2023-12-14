<?php
include_once(__DIR__ . "/../../controllers/earning-controller.php");

$earningController = new EarningController();

$earning_title = $_POST["title"];
$earning_amount = $_POST["amount"];
$earning_event_id = $_POST["event_id"];

$earning = new Earning(null, $earning_title, $earning_amount, $earning_event_id);

$earningController->insertEarning($earning);

header("Location: ../event.php?event_id=" . $earning_event_id);

?>