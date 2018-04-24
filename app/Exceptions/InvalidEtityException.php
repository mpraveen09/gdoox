<?php namespace Gdoox\Exceptions;

class InvalidEntityException extends GdooxBaseException
{
    private $entity;

    public function getEntity()
    {
        return $this->entity;
    }

    public function setEntity($entity)
    {
        $this->entity = $entity;
    }
}
