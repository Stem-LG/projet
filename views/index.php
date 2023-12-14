<?php

include_once(__DIR__ . "/../controllers/event-controller.php");

$eventController = new EventController();

$stats = $eventController->getStats();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-200 py-4 px-4 max-w-7xl mx-auto">
    <!-- App bar -->
    <div class="flex h-16 bg-white mb-4 items-center p-4 gap-2">
        <div class="flex-1">
            <h1 class="text-2xl font-bold">BudgetTrack</h1>
        </div>
        <div>
            <a href="index.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Dashboard</a>
        </div>
        <div>
            <a href="events.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Events</a>
        </div>
    </div>
    <div class="px-4 text-center">
        <h2 class="text-xl font-bold mb-2">Dashboard</h2>
        <div class="flex flex-wrap gap-4 justify-center">
            <div class="bg-white rounded shadow p-4 mb-4 w-56">
                <h3 class="text-lg font-bold mb-2">Total Funds</h3>
                <p class="text-2xl font-bold mb-2">$
                    <?php echo $stats["funds"] ?>
                </p>
            </div>
            <div class="bg-white rounded shadow p-4 mb-4 w-56">
                <h3 class="text-lg font-bold mb-2">Total Spendings</h3>
                <p class="text-2xl font-bold mb-2">$
                    <?php echo $stats["expenses"] ?>
                </p>
            </div>
            <div class="bg-white rounded shadow p-4 mb-4 w-56">
                <h3 class="text-lg font-bold mb-2">Total Earnings</h3>
                <p class="text-2xl font-bold mb-2">$
                    <?php echo $stats["earnings"] ?>
                </p>
            </div>
            <div class="bg-white rounded shadow p-4 mb-4 w-56">
                <h3 class="text-lg font-bold mb-2">Remaining</h3>
                <p class="text-2xl font-bold mb-2">$
                    <?php echo $stats["funds"] + $stats["earnings"] - $stats["spendings"] ?>
                </p>
            </div>
        </div>
    </div>
</body>

</html>