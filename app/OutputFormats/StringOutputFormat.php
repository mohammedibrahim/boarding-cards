<?php
/**
 * String output format
 *
 * @package     Boarding Cards
 * @author      Mohamed Ibrahim <m.ibrahim@integrateddev.com>
 * @version     v.1.0 (08/11/2017)
 * @copyright   Copyright (c) 2016, Integrated Development
 */

namespace BoardingCards\OutputFormats;

use BoardingCards\Contracts\OutputFormat;

/**
 * String output format.
 *
 * Class StringOutputFormat
 * @package BoardingCards\OutputFormats
 */
class StringOutputFormat extends AbstractOutputFormat implements OutputFormat
{

    private $_separator;

    /**
     * Constructor
     *
     * StringOutputFormat constructor.
     * @param string $separator
     */
    public function __construct($separator = "\n")
    {
        $this->_separator = $separator;
    }

    /**
     * Create New Instance.
     *
     * @param string $separator
     * @return mixed
     */
    static public function instance($separator = "\n")
    {
        $instance = get_called_class();
        return new $instance($separator);
    }

    /**
     * Format boarding card output
     *
     * @param $data
     * @return mixed
     */
    public function format($data)
    {
        return call_user_func_array('sprintf', $data);
    }

    /**
     * Output boarding cards
     *
     * @param $boardingCardsToStrings
     * @return mixed
     */
    public function allCardsFormat($boardingCardsToStrings)
    {
        $separator = $this->_separator;

        return implode($separator, $boardingCardsToStrings) . $separator;
    }
}