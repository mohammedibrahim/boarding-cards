<?php namespace BoardingCards\Contracts;

/**
 * Counter Boarding cards for boarding cards that have gate number.
 *
 * Interface GateBoardingCards
 * @package BoardingCards\Contracts
 */
Interface BaggageBoardingCardAttributes {

    /**
     * Set Package Details
     *
     * @param $baggageDetails
     * @return mixed
     */
    public function setBaggageDetails($baggageDetails);

    /**
     * Must Return Counter number
     *
     * @return mixed
     */
    public function getBaggageDetails();
}