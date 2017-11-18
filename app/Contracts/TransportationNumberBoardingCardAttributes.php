<?php
/**
 * Transportation Number Boarding cards interface
 *
 * @package     Boarding Cards
 * @author      Mohamed Ibrahim <m.ibrahim@integrateddev.com>
 * @version     v.1.0 (08/11/2017)
 * @copyright   Copyright (c) 2016, Integrated Development
 */

namespace BoardingCards\Contracts;

/**
 * Transportation Number Boarding cards for boarding cards that have gate number.
 *
 * Interface GateBoardingCards
 * @package BoardingCards\Contracts
 */
Interface TransportationNumberBoardingCardAttributes {

    /**
     * Set Transportation Number.
     *
     * @param $transportationNumber
     * @return mixed
     */
    public function setTransportationNumber($transportationNumber);

    /**
     * Must Return Gate number
     *
     * @return mixed
     */
    public function getTransportationNumber();
}