<?php

abstract class DomainEvent
{
    protected $eventName;
    protected $occurredOn;

    public function __construct($eventName)
    {
        $this->eventName = $eventName;
        $this->occurredOn = new DateTimeImmutable();
    }

    public function eventName()
    {
        return $this->eventName;
    }

    public function occurredOn()
    {
        return $this->occurredOn;
    }

    abstract public function payload();
}
