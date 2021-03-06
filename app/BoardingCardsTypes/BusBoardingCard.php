<?php
/**
 * Bus Boarding Card Class
 *
 * @package     Boarding Cards
 * @author      Mohamed Ibrahim <m.ibrahim@integrateddev.com>
 * @version     v.1.0 (08/11/2017)
 * @copyright   Copyright (c) 2016, Integrated Development
 */

namespace BoardingCards\BoardingCardsTypes;

use BoardingCards\Contracts\OutputFormat;

/**
 * Bus Boarding card class.
 *
 * Class AbstractBoardingCards
 * @package BoardingCards\BoardingCardsTypes
 */
class BusBoardingCard extends AbstractBoardingCard
{
    /**
     * Output Boarding Card details.
     *
     * @param OutputFormat $format
     * @return mixed
     */
    public function output(OutputFormat $format)
    {
        return $format->format([
            'Take the airport bus from %s to %s. No seat assignment.',
            $this->getFrom(),
            $this->getTo()
        ]);
    }
}