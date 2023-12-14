<?php
include_once(__DIR__ . "/../../controllers/event-controller.php");

$eventController = new EventController();

$event_name = $_POST["name"];

$event = new Event(null, $event_name);

$eventController->insertEvent($event);

header("Location: ../events.php");
?>