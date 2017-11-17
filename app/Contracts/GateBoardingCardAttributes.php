<?php namespace BoardingCards\Contracts;

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