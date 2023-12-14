<?php 
include_once(__DIR__ . "/../../controllers/expense-controller.php");

$expenseController = new ExpenseController();

$expense_id = $_GET["id"];

$expense = new Expense($expense_id, null, null, null);

$expenseController->deleteExpense($expense);

header("Location: ../event.php?event_id=" . $_GET["event_id"]);
?>