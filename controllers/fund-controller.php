<?php
include_once(__DIR__ . "/../db.php");
include_once(__DIR__ . "/../models/Fund.php");

class FundController extends Connexion
{
    function __construct()
    {
        parent::__construct();
    }

    public function getFunds($event_id)
    {
        $query = "SELECT * FROM funds WHERE event_id = ?";
        $res = $this->pdo->prepare($query);
        $res->execute([$event_id]);
        $arr = $res->fetchAll();

        $funds = array();
        foreach ($arr as $f) {
            $funds[] = new Fund($f["id"], $f["title"], $f["amount"], $f["event_id"]);
        }

        return $funds;
    }

    public function insertFund(Fund $fund)
    {
        $query = "INSERT INTO funds (event_id, title, amount) VALUES (?, ?, ?)";
        $res = $this->pdo->prepare($query);
        return $res->execute([$fund->getEventId(), $fund->getTitle(), $fund->getAmount()]);
    }

    public function deleteFund(Fund $fund)
    {
        $query = "DELETE FROM funds WHERE id = ?";
        $res = $this->pdo->prepare($query);
        return $res->execute([$fund->getId()]);
    }

    public function updateFund(Fund $fund)
    {
        $query = "UPDATE funds SET title = ?, amount = ? WHERE id = ?";
        $res = $this->pdo->prepare($query);
        return $res->execute([$fund->getTitle(), $fund->getAmount(), $fund->getId()]);
    }
}

?>