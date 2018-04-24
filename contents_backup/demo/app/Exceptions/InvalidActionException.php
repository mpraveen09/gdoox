<?php namespace Gdoox\Exceptions;


class InvalidActionException extends GdooxBaseException
{
    /**
     * @var
     */
    private $action;

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }
}
