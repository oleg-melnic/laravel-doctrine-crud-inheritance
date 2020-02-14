<?php

namespace App\Crud\Exception;

/**
 * Class ValidationException
 */
class ValidationException extends \InvalidArgumentException implements ExceptionInterface
{
    /**
     * @var array
     */
    protected $validationMessages;

    /**
     * @return array
     */
    public function getValidationMessages()
    {
        return $this->validationMessages;
    }

    /**
     * @param array $messages
     */
    public function setValidationMessages(array $messages)
    {
        $this->validationMessages = $messages;
    }
}
