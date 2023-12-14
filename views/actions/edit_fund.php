<?php

include_once(__DIR__ . "/../../controllers/fund-controller.php");

$fundController = new FundController();

$fund_id = $_POST["id"];

$fund_title = $_POST["title"];

$fund_amount = $_POST["amount"];

$fund_event_id = $_POST["event_id"];

$fund = new Fund($fund_id, $fund_title, $fund_amount, $fund_event_id);

$fundController->updateFund($fund);

header("Location: ../event.php?event_id=" . $fund_event_id);
?>