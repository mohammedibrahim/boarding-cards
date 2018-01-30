<?php
/**
 * Abstract Class for output format
 *
 * @package     Boarding Cards
 * @author      Mohamed Ibrahim <m.ibrahim@integrateddev.com>
 * @version     v.1.0 (08/11/2017)
 * @copyright   Copyright (c) 2016, Integrated Development
 */

namespace BoardingCards\OutputFormats;

use BoardingCards\Contracts\OutputFormat;

/**
 * Abstract Class for output format of boarding cards
 *
 * Class AbstractStringOutputFormat
 * @package BoardingCards\OutputFormats
 */
abstract class AbstractOutputFormat implements OutputFormat
{
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
     * Format boarding card output
     *
     * @param $data
     * @return mixed
     */
    abstract public function format($data);

    /**
     * Output boarding cards
     *
     * @param $boardingCards
     * @return mixed
     */
    abstract public function allCardsFormat($boardingCards);
}
