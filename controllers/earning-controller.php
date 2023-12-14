<?php
include_once(__DIR__ . "/../db.php");
include_once(__DIR__ . "/../models/Earning.php");

class EarningController extends Connexion
{
    function __construct()
    {
        parent::__construct();
    }

    public function getEarnings($event_id)
    {
        $query = "SELECT * FROM earnings WHERE event_id = ?";
        $res = $this->pdo->prepare($query);
        $res->execute([$event_id]);
        $arr = $res->fetchAll();

        $earnings = array();
        foreach ($arr as $e) {
            $earnings[] = new Earning($e["id"], $e["title"], $e["amount"], $e["event_id"]);
        }
        return $earnings;
    }

    public function insertEarning(Earning $earning)
    {
        $query = "INSERT INTO earnings (event_id, title, amount) VALUES (?, ?, ?)";
        $res = $this->pdo->prepare($query);
        return $res->execute([$earning->getEventId(), $earning->getTitle(), $earning->getAmount()]);
    }

    public function deleteEarning(Earning $earning)
    {
        $query = "DELETE FROM earnings WHERE id = ?";
        $res = $this->pdo->prepare($query);
        return $res->execute([$earning->getId()]);
    }

    public function updateEarning(Earning $earning)
    {
        $query = "UPDATE earnings SET amount = ?, title = ? WHERE id = ?";
        $res = $this->pdo->prepare($query);
        return $res->execute([$earning->getAmount(), $earning->getTitle(), $earning->getId()]);
    }
}
?>