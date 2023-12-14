<?php

class Expense
{


    private $id, $title, $amount, $event_id;

    function __construct($id = "", $title = "", $amount = 0, $event_id = "")
    {
        $this->id = $id;
        $this->title = $title;
        $this->amount = $amount;
        $this->event_id = $event_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getEventId()
    {
        return $this->event_id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function setEventId($event_id)
    {
        $this->event_id = $event_id;
    }

}
