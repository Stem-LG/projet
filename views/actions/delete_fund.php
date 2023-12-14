<?php
include_once(__DIR__ . "/../../controllers/fund-controller.php");

$fundController = new FundController();

$fund_id = $_GET["id"];

$fund = new Fund($fund_id, null, null, null);

$fundController->deleteFund($fund);

header("Location: ../event.php?event_id=" . $_GET["event_id"]);
?>