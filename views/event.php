<?php

include_once(__DIR__ . "/../controllers/event-controller.php");
include_once(__DIR__ . "/../controllers/fund-controller.php");
include_once(__DIR__ . "/../controllers/expense-controller.php");
include_once(__DIR__ . "/../controllers/earning-controller.php");

$eventController = new EventController();
$fundController = new FundController();
$expenseController = new ExpenseController();
$earningController = new EarningController();

$event = $eventController->getEvent($_GET["event_id"]);


$funds = $fundController->getFunds($event->getId());

$expenses = $expenseController->getExpenses($event->getId());

$earnings = $earningController->getEarnings($event->getId());
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
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
    <h2 class="text-xl font-bold mb-2 text-center">Event:
        <?php echo $event->getName(); ?>
    </h2>
    <div class=" flex flex-wrap gap-4 justify-center">
        <table class="w-84 text-sm text-center text-gray-700">

            <thead class="text-xs  text-white uppercase bg-blue-500">
                <tr>
                    <th colspan="3" class="px-6 py-3 bg-blue-600">Funds</th>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">title</th>
                    <th scope="col" class="px-6 py-3">amount</th>
                    <th scope="col" class="px-6 py-3">action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($funds as $index => $fund) {
                    ?>
                    <tr style="height: 45px" class="bg-white border-b">
                        <td>
                            <?php echo $fund->getTitle(); ?>
                        </td>
                        <td>
                            <?php echo $fund->getAmount(); ?>
                        </td>
                        <td>
                            <!-- delete and edit buttons -->
                            <button onclick="showDialog('edit_fund',<?php echo $index; ?>)" class="mx-auto bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                                <svg class="feather feather-edit" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>
                            </button>
                            <button onclick="deleteFund(<?php echo $fund->getId() ?>)" class="mx-auto bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                <svg height="24" viewBox="0 0 48 48" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor" d="M12 38c0 2.21 1.79 4 4 4h16c2.21 0 4-1.79 4-4v-24h-24v24zm26-30h-7l-2-2h-10l-2 2h-7v4h28v-4z" />
                                    <path d="M0 0h48v48h-48z" fill="none" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
                <td colspan='3' class="pt-2">
                    <button onclick="showDialog('add_fund',null)" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Add new fund
                    </button>
                </td>
            </tbody>
        </table>
        <table class="w-84 text-sm text-center text-gray-700">

            <thead class="text-xs  text-white uppercase bg-blue-500">
                <tr>
                    <th colspan="3" class="px-6 py-3 bg-blue-600">Expenses</th>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">title</th>
                    <th scope="col" class="px-6 py-3">amount</th>
                    <th scope="col" class="px-6 py-3">action</th>

                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($expenses as $index => $expense) {
                    ?>
                    <tr style="height: 45px" class="bg-white border-b">
                        <td>
                            <?php echo $expense->getTitle(); ?>
                        </td>
                        <td>
                            <?php echo $expense->getAmount(); ?>
                        </td>
                        <td>
                            <!-- delete and edit buttons -->
                            <button onclick="showDialog('edit_expense',<?php echo $index; ?>)" class="mx-auto bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                                <svg class="feather feather-edit" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>
                            </button>
                            <button onclick="deleteExpense(<?php echo $expense->getId() ?>)" class="mx-auto bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                <svg height="24" viewBox="0 0 48 48" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor" d="M12 38c0 2.21 1.79 4 4 4h16c2.21 0 4-1.79 4-4v-24h-24v24zm26-30h-7l-2-2h-10l-2 2h-7v4h28v-4z" />
                                    <path d="M0 0h48v48h-48z" fill="none" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
                <td colspan='3' class="pt-2">
                    <button onclick="showDialog('add_expense',null)" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Add new expense
                    </button>
                </td>
            </tbody>
        </table>
        <table class="w-84 text-sm text-center text-gray-700">

            <thead class="text-xs  text-white uppercase bg-blue-500">
                <tr>
                    <th colspan="3" class="px-6 py-3 bg-blue-600">Earnings</th>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">title</th>
                    <th scope="col" class="px-6 py-3">amount</th>
                    <th scope="col" class="px-6 py-3">action</th>

                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($earnings as $index => $earning) {
                    ?>
                    <tr style="height: 45px" class="bg-white border-b">
                        <td>
                            <?php echo $earning->getTitle(); ?>
                        </td>
                        <td>
                            <?php echo $earning->getAmount(); ?>
                        </td>
                        <td>
                            <!-- delete and edit buttons -->
                            <button onclick="showDialog('edit_earning',<?php echo $index; ?>)" class="mx-auto bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                                <svg class="feather feather-edit" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>
                            </button>
                            <button onclick="deleteEarning(<?php echo $earning->getId() ?>)" class="mx-auto bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                <svg height="24" viewBox="0 0 48 48" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor" d="M12 38c0 2.21 1.79 4 4 4h16c2.21 0 4-1.79 4-4v-24h-24v24zm26-30h-7l-2-2h-10l-2 2h-7v4h28v-4z" />
                                    <path d="M0 0h48v48h-48z" fill="none" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan='3' class="pt-2">
                        <button onclick="showDialog('add_earning',null)" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Add new earning
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>


    <dialog id="multi_dialog" class="top-0 right-0 left-0 p-0 justify-center items-center w-92">
        <div class="relative bg-white rounded-lg shadow ">
            <div class="flex items-center justify-between p-4  border-b rounded-t">
                <h3 id="dialog_title" class="text-lg font-semibold text-gray-900">
                    Edit Fund
                </h3>
                <button onclick="multi_dialog.close()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <form id="dialog_form" method="post" class="p-4 md:p-5">
                <input type="hidden" name="id" id="edit_id">
                <input type="hidden" name="event_id" value="<?php echo $event->getId(); ?>">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                        <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Type title" required>
                    </div>
                    <div class="col-span-2">
                        <label for="amount" class="block mb-2 text-sm font-medium text-gray-900">Amount</label>
                        <input type="number" name="amount" id="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Type title" required>
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    confirm
                </button>
            </form>
        </div>
    </dialog>


    <script>

        const funds = <?php
        echo json_encode(array_map(function ($fund) {
            return [
                "id" => $fund->getId(),
                "title" => $fund->getTitle(),
                "amount" => $fund->getAmount()
            ];
        }, $funds));
        ?>;

        const expenses = <?php
        echo json_encode(array_map(function ($expense) {
            return [
                "id" => $expense->getId(),
                "title" => $expense->getTitle(),
                "amount" => $expense->getAmount()
            ];
        }, $expenses));
        ?>;

        const earnings = <?php
        echo json_encode(array_map(function ($earning) {
            return [
                "id" => $earning->getId(),
                "title" => $earning->getTitle(),
                "amount" => $earning->getAmount()
            ];
        }, $earnings));
        ?>;


        var multi_dialog = document.getElementById('multi_dialog');
        var dialog_title = document.getElementById('dialog_title');
        var edit_id = document.getElementById('edit_id');
        var title = document.getElementById('title');
        var amount = document.getElementById('amount');
        var dialog_form = document.getElementById('dialog_form');

        function showDialog(type, id) {

            if (type == 'add_fund') {
                dialog_title.innerHTML = 'Add Fund';
                dialog_form.action = 'actions/add_fund.php';
                clearDialog()
            } else if (type == 'add_expense') {
                dialog_title.innerHTML = 'Add Expense';
                dialog_form.action = 'actions/add_expense.php';
                clearDialog()
            } else if (type == 'add_earning') {
                dialog_title.innerHTML = 'Add Earning';
                dialog_form.action = 'actions/add_earning.php';
                clearDialog()
            } else if (type == 'edit_fund') {
                dialog_title.innerHTML = 'Edit Fund';
                dialog_form.action = 'actions/edit_fund.php';
                edit_id.value = funds[id].id;
                title.value = funds[id].title;
                amount.value = funds[id].amount;
            } else if (type == 'edit_expense') {
                dialog_title.innerHTML = 'Edit Expense';
                dialog_form.action = 'actions/edit_expense.php';
                edit_id.value = expenses[id].id;
                title.value = expenses[id].title;
                amount.value = expenses[id].amount;
            } else if (type == 'edit_earning') {
                dialog_title.innerHTML = 'Edit Earning';
                dialog_form.action = 'actions/edit_earning.php';
                edit_id.value = earnings[id].id;
                title.value = earnings[id].title;
                amount.value = earnings[id].amount;
            }
            multi_dialog.showModal();
        }

        function clearDialog() {
            title.value = '';
            amount.value = '';
        }

        function deleteFund(id) {
            if (confirm('Are you sure you want to delete this fund?')) {
                window.location.href = 'actions/delete_fund.php?id=' + id + "&event_id=" + <?php echo $event->getId(); ?>
            }
        }

        function deleteExpense(id) {
            if (confirm('Are you sure you want to delete this expense?')) {
                window.location.href = 'actions/delete_expense.php?id=' + id + "&event_id=" + <?php echo $event->getId(); ?>
            }
        }

        function deleteEarning(id) {
            if (confirm('Are you sure you want to delete this earning?')) {
                window.location.href = 'actions/delete_earning.php?id=' + id + "&event_id=" + <?php echo $event->getId(); ?>
            }
        }
    </script>

</body>

</html>