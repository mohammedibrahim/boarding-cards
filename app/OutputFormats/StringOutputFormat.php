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
class StringOutputFormat extends AbstractStringOutputFormat implements OutputFormat
{
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
}