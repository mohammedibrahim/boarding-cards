<?php
/**
 * Flight Boarding card class
 *
 * @package     Boarding Cards
 * @author      Mohamed Ibrahim <m.ibrahim@integrateddev.com>
 * @version     v.1.0 (08/11/2017)
 * @copyright   Copyright (c) 2016, Integrated Development
 */

namespace BoardingCards\BoardingCardsTypes;

use BoardingCards\Contracts\BaggageBoardingCardAttributes;
use BoardingCards\Contracts\GateBoardingCardAttributes;
use BoardingCards\Contracts\SeatableBoardingCardAttributes;
use BoardingCards\Contracts\TransportationNumberBoardingCardAttributes;

/**
 * Flight Boarding card class.
 *
 * Class AbstractBoardingCards
 * @package BoardingCards\BoardingCardsTypes
 */
class FlightBoardingCard extends AbstractBoardingCard implements
    SeatableBoardingCardAttributes,
    TransportationNumberBoardingCardAttributes,
    GateBoardingCardAttributes,
    BaggageBoardingCardAttributes
{
    /**
     * Appended Attributes
     *
     * @var array
     */
    protected $_appendedDefaults = [
        'seat_number' => '',
        'transportation_number' => '',
        'gate_number' => '',
        'baggage_details' => '',
    ];

    /**
     * Seat Number.
     *
     * @var
     */
    protected $_seatNumber;

    /**
     * Transportation Number.
     *
     * @var
     */
    protected $_transportationNumber;

    /**
     * Gate Number.
     *
     * @var
     */
    protected $_gateNumber;

    /**
     * Counter Number.
     *
     * @var
     */
    protected $_baggageDetails;

    /**
     * Set Package Details
     *
     * @param $baggageDetails
     * @return mixed
     */
    public function setBaggageDetails($baggageDetails)
    {
        $this->_baggageDetails = $baggageDetails;

        return $this;
    }

    /**
     * Must Return Counter number
     *
     * @return mixed
     */
    public function getBaggageDetails()
    {
        return $this->_baggageDetails;
    }

    /**
     * Set Gate Number.
     *
     * @param $gateNumber
     * @return $this
     */
    public function setGateNumber($gateNumber)
    {
        $this->_gateNumber = $gateNumber;

        return $this;
    }

    /**
     * Must Return Gate number
     *
     * @return mixed
     */
    public function getGateNumber()
    {
        return $this->_gateNumber;
    }

    /**
     * Set Seat Number.
     *
     * @param $seatNumber
     * @return $this
     */
    public function setSeatNumber($seatNumber)
    {
        $this->_seatNumber = $seatNumber;

        return $this;
    }

    /**
     * Must Return Seat number
     *
     * @return mixed
     */
    public function getSeatNumber()
    {
        return $this->_seatNumber;
    }

    /**
     * Set Transportation Number.
     *
     * @param $transportationNumber
     * @return $this
     */
    public function setTransportationNumber($transportationNumber)
    {
        $this->_transportationNumber = $transportationNumber;

        return $this;
    }

    /**
     * Must Return Gate number
     *
     * @return mixed
     */
    public function getTransportationNumber()
    {
        return $this->_transportationNumber;
    }

    /**
     * Output Boarding Card Text to string.
     *
     * @return mixed
     */
    public function outputToString()
    {
        return sprintf(
            'From %s, take flight %s to %s. Gate %s, Seat %s, %s.',
            $this->getFrom(),
            $this->getTransportationNumber(),
            $this->getTo(),
            $this->getGateNumber(),
            $this->getSeatNumber(),
            $this->getBaggageDetails()
        );
    }
}