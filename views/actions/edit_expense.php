<?php

include_once(__DIR__ . "/../../controllers/expense-controller.php");

$expenseController = new ExpenseController();

$expense_id = $_POST["id"];

$expense_title = $_POST["title"];

$expense_amount = $_POST["amount"];

$expense_event_id = $_POST["event_id"];

$expense = new Expense($expense_id, $expense_title, $expense_amount, $expense_event_id);

$expenseController->updateExpense($expense);

header("Location: ../event.php?event_id=" . $expense_event_id);

?>