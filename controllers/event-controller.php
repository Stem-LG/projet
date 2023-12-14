<?php

include_once(__Dir__."/../db.php");
include_once(__DIR__ ."/../models/event.php");



class EventController extends Connexion
{

    function __construct()
    {
        parent::__construct();
    }


    public function getStats()
    {

        //get sum of all funds, expenese and earnings seperatly
        $query = "SELECT SUM(amount) as total FROM funds";
        $res = $this->pdo->prepare($query);
        $res->execute();
        $funds = $res->fetch();

        $query = "SELECT SUM(amount) as total FROM earnings";
        $res = $this->pdo->prepare($query);
        $res->execute();
        $earnings = $res->fetch();

        $query = "SELECT SUM(amount) as total FROM expenses";
        $res = $this->pdo->prepare($query);
        $res->execute();
        $expenses = $res->fetch();

        return array(
            "funds" => $funds["total"],
            "earnings" => $earnings["total"],
            "expenses" => $expenses["total"]
        );

    }

    public function getEvents()
    {
        $query = "SELECT * FROM events";
        $res = $this->pdo->prepare($query);
        $res->execute();
        $arr = $res->fetchAll();

        $events = array();
        foreach ($arr as $e) {
            $events[] = new Event($e["id"], $e["name"]);
        }

        return $events;
    }

    public function getEvent($id)
    {
        $query = "SELECT * FROM events WHERE id = ? ";
        $res = $this->pdo->prepare($query);
        $res->execute(array($id));
        $arr = $res->fetch();

        if (!$arr)
            return false;

        $e = new Event($arr["id"], $arr["name"]);

        return $e;
    }

    public function insertEvent(Event $event)
    {
        $query = "INSERT INTO events(name) VALUES(?)";
        $res = $this->pdo->prepare($query);
        $arr = array($event->getName());
        
        return $res->execute($arr);
    }

    public function deleteEvent($id)
    {
        $sql = "DELETE FROM events WHERE id=?";
        $res = $this->pdo->prepare($sql);
        $res->execute(array($id));
    }

    public function updateEvent(Event $event)
    {
        $sql = "UPDATE events SET name=? WHERE id=?";
        $res = $this->pdo->prepare($sql);
        return $res->execute(array($event->getName(), $event->getId()));
    }

}