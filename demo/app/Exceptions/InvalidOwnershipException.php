<?php namespace Gdoox\Exceptions;

class InvalidOwnershipException extends GdooxBaseException
{
    /**
     * @var
     */
    private $ownership;

    /**
     * @return mixed
     */
    public function getOwnership()
    {
        return $this->ownership;
    }

    /**
     * @param $ownership
     */
    public function setOwnership($ownership)
    {
        $this->ownership = $ownership;
    }
}
