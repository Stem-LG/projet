<?php
include_once(__DIR__ ."/../../controllers/event-controller.php");

$eventController = new EventController();

$event_id = $_GET["event_id"];

$eventController->deleteEvent($event_id);

header("Location: ../events.php");
?>