<?php
include_once(__DIR__ . "/../../controllers/earning-controller.php");

$earningController = new EarningController();

$earning_id = $_GET["id"];

$earning = new Earning($earning_id, null, null, null);

$earningController->deleteEarning($earning);

header("Location: ../event.php?event_id=" . $_GET["event_id"]);
?>