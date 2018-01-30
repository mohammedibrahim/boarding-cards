<?php
/**
 * Boarding Card Abstract Class
 *
 * @package     Boarding Cards
 * @author      Mohamed Ibrahim <m.ibrahim@integrateddev.com>
 * @version     v.1.0 (08/11/2017)
 * @copyright   Copyright (c) 2016, Integrated Development
 */

namespace BoardingCards\BoardingCardsTypes;

use BoardingCards\Contracts\GeneralBoardingCardAttributes;
use BoardingCards\Contracts\OutputFormat;
use BoardingCards\Exceptions\BoardingCardsException;

/**
 * Main Ticket Abstact class that contains the general tickets attributes.
 *
 * Class AbstractBoardingCards
 * @package BoardingCards\BoardingCardsTypes
 */
Abstract class AbstractBoardingCard implements GeneralBoardingCardAttributes
{
    /**
     * Default Value for boarding Cards
     *
     * @var array
     */
    protected $_defaults = [
        'to' => '',
        'from' => ''
    ];

    /**
     * Appended Defaults for boarding cards attributes
     *
     * @var array
     */
    protected $_appendedDefaults = [];

    /**
     * To City
     *
     * @var To city
     */
    protected $_to;

    /**
     * From City
     *
     * @var From City
     */
    protected $_from;

    /**
     * Get From City
     *
     * @return From City
     */
    public function getFrom()
    {
        return $this->_from;
    }

    /**
     * Set From
     *
     * @param $from
     * @return $this
     */
    public function setFrom($from)
    {
        $this->_from = $from;

        return $this;
    }

    /**
     * Set To
     *
     * @param $to
     * @return $this
     */
    public function setTo($to)
    {
        $this->_to = $to;

        return $this;
    }

    /**
     * get To
     *
     * @return To
     */
    public function getTo()
    {
        return $this->_to;
    }

    /**
     * Create New Instance.
     *
     * @return mixed
     */
    static public function instance()
    {
        $instance = get_called_class();
        return new $instance();
    }

    /**
     * Create Boarding Card.
     *
     * @param array $cardBoardingDetails
     * @return $this
     * @throws BoardingCardsException
     */
    public function createBoardingCard(array $cardBoardingDetails)
    {
        if (!empty($this->_appendedDefaults)) {
            $this->_defaults += $this->_appendedDefaults;
        }

        $cardBoardingDetails = array_replace_recursive($this->_defaults, $cardBoardingDetails);

        if (empty(array_filter($cardBoardingDetails))) {
            throw new BoardingCardsException('Boarding Card Information are missing!');
        }

        foreach ($cardBoardingDetails as $key => $value) {

            $method = $this->getMethodName($key);

            if (method_exists($this, $method)) {

                if (empty($value)) {
                    throw new BoardingCardsException($key . ' must have a value!');
                }

                $this->{$method}($value);
            } else {
                throw new BoardingCardsException($key . ' isn\'t a valid boarding card option!');
            }
        }

        return $this;
    }

    /**
     * Convert string to camel case.
     *
     * @param $key
     * @return string
     */
    protected function getMethodName($key)
    {
        $methodName = 'set' . str_replace('_', '', ucwords($key, '_'));

        return $methodName;
    }

    /**
     * Output Boarding Card details.
     *
     * @param OutputFormat $format
     * @return mixed
     */
    abstract public function output(OutputFormat $format);

}
