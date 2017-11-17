<?php namespace BoardingCards\Contracts;

/**
 * Contains common card attributes between different boarding cards type.
 *
 * Interface GeneralTicketItems
 * @package BoardingCards\Contracts
 */
Interface GeneralBoardingCardAttributes {

    /**
     * Set From city.
     *
     * @return mixed
     */
    public function setFrom($from);

    /**
     * Must Return From city of boarding card.
     *
     * @return mixed
     */
    public function getFrom();

    /**
     * Set To City
     * @return mixed
     */
    public function setTo($to);

    /**
     * Must Return To city of boarding card.
     *
     * @return mixed
     */
    public function getTo();

}