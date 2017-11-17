<?php namespace BoardingCards\Contracts;
/**
 * Seatable Borading card contact for cards that have seat number.
 *
 * Interface SeatableBoardingCards
 * @package BoardingCards\Contracts
 */
Interface SeatableBoardingCardAttributes {

    /**
     * Set Seat Number.
     *
     * @return mixed
     */
    public function setSeatNumber($seatNumber);
    /**
     * Must Return Seat number
     *
     * @return mixed
     */
    public function getSeatNumber();
}