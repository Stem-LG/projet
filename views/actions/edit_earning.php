<?php

include_once(__DIR__ . "/../../controllers/earning-controller.php");

$earningController = new EarningController();

$earning_id = $_POST["id"];

$earning_title = $_POST["title"];

$earning_amount = $_POST["amount"];

$earning_event_id = $_POST["event_id"];

$earning = new Earning($earning_id, $earning_title, $earning_amount, $earning_event_id);

$earningController->updateEarning($earning);

header("Location: ../event.php?event_id=" . $earning_event_id);

?>