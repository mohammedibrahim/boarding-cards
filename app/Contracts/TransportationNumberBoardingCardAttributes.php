<?php namespace BoardingCards\Contracts;

/**
 * Gate Boarding cards for boarding cards that have gate number.
 *
 * Interface GateBoardingCards
 * @package BoardingCards\Contracts
 */
Interface TransportationNumberBoardingCardAttributes {

    /**
     * Set Transportation.
     *
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