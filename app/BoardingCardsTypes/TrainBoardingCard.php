<?php
/**
 * Train Boarding card class
 *
 * @package     Boarding Cards
 * @author      Mohamed Ibrahim <m.ibrahim@integrateddev.com>
 * @version     v.1.0 (08/11/2017)
 * @copyright   Copyright (c) 2016, Integrated Development
 */

namespace BoardingCards\BoardingCardsTypes;

use BoardingCards\Contracts\OutputFormat;
use BoardingCards\Contracts\SeatableBoardingCardAttributes;
use BoardingCards\Contracts\TransportationNumberBoardingCardAttributes;

/**
 * Train Boarding card class.
 *
 * Class AbstractBoardingCards
 * @package BoardingCards\BoardingCardsTypes
 */
class TrainBoardingCard extends AbstractBoardingCard implements
    SeatableBoardingCardAttributes,
    TransportationNumberBoardingCardAttributes
{
    /**
     * Appended Defaults for boarding cards attributes
     *
     * @var array
     */
    protected $_appendedDefaults = [
        'seat_number' => '',
        'transportation_number' => '',
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
     * Output Boarding Card details.
     *
     * @param OutputFormat $format
     * @return mixed
     */
    public function output(OutputFormat $format)
    {
        return $format->format([
            'Take train %s from %s to %s. Sit in seat %s.',
            $this->getTransportationNumber(),
            $this->getFrom(),
            $this->getTo(),
            $this->getSeatNumber()
        ]);
    }
}