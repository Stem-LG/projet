<?php
include_once(__DIR__ . "/../db.php");
include_once(__DIR__ . "/../models/Expense.php");

class ExpenseController extends Connexion
{
    function __construct()
    {
        parent::__construct();
    }

    public function getExpenses($event_id)
    {
        $query = "SELECT * FROM expenses WHERE event_id = ?";
        $res = $this->pdo->prepare($query);
        $res->execute([$event_id]);
        $arr = $res->fetchAll();

        $expenses = array();
        foreach ($arr as $e) {
            $expenses[] = new Expense($e["id"], $e["title"], $e["amount"], $e["event_id"]);
        }

        return $expenses;
    }

    public function insertExpense(Expense $expense)
    {
        $query = "INSERT INTO expenses (event_id, title, amount) VALUES (?, ?, ?)";
        $res = $this->pdo->prepare($query);
        return $res->execute([$expense->getEventId(), $expense->getTitle(), $expense->getAmount()]);
    }

    public function deleteExpense(Expense $expense)
    {
        $query = "DELETE FROM expenses WHERE id = ?";
        $res = $this->pdo->prepare($query);
        return $res->execute([$expense->getId()]);
    }

    public function updateExpense(Expense $expense)
    {
        $query = "UPDATE expenses SET amount = ?, title = ? WHERE id = ?";
        $res = $this->pdo->prepare($query);
        return $res->execute([$expense->getAmount(), $expense->getTitle(), $expense->getId()]);
    }
}
?>