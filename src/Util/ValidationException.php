<?php
namespace PhalconRest\Util;

/**
 * where caught HTTP Exceptions go to die
 *
 * @author jjenkins
 *        
 */
class ValidationException extends \Exception
{

    /**
     * store a copy of the DI
     */
    private $di;

    /**
     *
     * @param string $message            
     * @param string $code            
     * @param array $errorArray            
     */
    public function __construct($title, $errorList, $validationList)
    {
        // store general error data
        $this->errorStore = new \PhalconRest\Util\ErrorStore($errorList);
        $this->errorStore->title = $title;
        $this->errorStore->validationList = $validationList;
        
        $this->di = \Phalcon\DI::getDefault();
    }

    /**
     *
     * @return void|boolean
     */
    public function send()
    {
        $output = new \PhalconRest\API\Output();
        $output->setStatusCode('400', 'Bad Request');        
        $output->sendError($this->errorStore);
        return true;
    }
}