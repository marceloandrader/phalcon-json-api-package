<?php
namespace PhalconRest\Util;

/**
 * class to standardize what properites the API stores in each error
 *
 * @author jjenkins
 *        
 */
class ErrorStore
{

    /**
     * array of additional value that can be passed to the exception
     *
     * @var array
     */
    public $errorArray;

    /**
     *
     * @var string
     */
    public $title = '';

    /**
     *
     * @var unknown
     */
    public $code;

    /**
     *
     * @var unknown
     */
    public $more;

    /**
     *
     * @var unknown
     */
    public $dev;

    /**
     *
     * @var param
     */
    public $validationList = [];

    /**
     * http response code
     *
     * @var int
     */
    public $errorCode;

    public function __construct($errorList)
    {
        $di = \Phalcon\DI::getDefault();
        
        $this->dev = @$errorList['dev'];
        $this->code = @$errorList['code'];
        $this->more = @$errorList['more'];
        
        // pull from messageBag if no explicit devMessage is provided
        if (is_null($this->dev)) {
            $messageBag = $di->getMessageBag();
            $this->dev = $messageBag->getString();
        }
    }
}