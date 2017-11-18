<?php
/**
 * Gate Boarding cards interface
 *
 * @package     Boarding Cards
 * @author      Mohamed Ibrahim <m.ibrahim@integrateddev.com>
 * @version     v.1.0 (08/11/2017)
 * @copyright   Copyright (c) 2016, Integrated Development
 */

namespace BoardingCards\Contracts;

/**
 * Gate Boarding cards for boarding cards that have gate number.
 *
 * Interface GateBoardingCards
 * @package BoardingCards\Contracts
 */
Interface GateBoardingCardAttributes {

    /**
     * Set Gate Number.
     *
     * @param $gateNumber
     * @return mixed
     */
    public function setGateNumber($gateNumber);

    /**
     * Must Return Gate number
     *
     * @return mixed
     */
    public function getGateNumber();
}