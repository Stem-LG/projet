<?php

include_once("../controllers/event-controller.php");
$eventController = new EventController();
$events = $eventController->getEvents();

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
    <h2 class="text-xl font-bold mb-2 text-center">Events</h2>
    <div class=" flex flex-wrap gap-4 justify-center">
        <?php

        foreach ($events as $event) {
            ?>
            <div class="w-64 bg-white rounded shadow p-4 mb-4">
                <h2 class="text-xl font-bold mb-2">
                    <?php echo $event->getName(); ?>
                </h2>
                <div class="flex justify-between">
                    <button onclick="deleteEvent(<?php echo $event->getId() ?>)" class="bg-red-500 hover:bg-red-700 text-white font-bold mt-2 py-2 px-4 rounded">Delete</button>
                    <a href="event.php?event_id=<?php echo $event->getId() ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold mt-2 py-2 px-4 rounded">Details</a>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="flex justify-center">
        <button onclick="add_dialog.showModal()" class="mx-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Event</button>
    </div>


    <dialog id="add_dialog" class="top-0 right-0 left-0 p-0 justify-center items-center w-92">
        <div class="relative bg-white rounded-lg shadow ">
            <div class="flex items-center justify-between p-4  border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Add a new project
                </h3>
                <button onclick="add_dialog.close()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <form action="actions/add_event.php" method="post" class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Type project name" required>
                    </div>

                </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Add new project
                </button>
            </form>
        </div>
    </dialog>


    <script>
        function deleteEvent(id) {
            if (confirm("Are you sure you want to delete this event?")) {
                window.location.href = "actions/delete_event.php?event_id=" + id;
            }
        }
    </script>



</body>

</html>