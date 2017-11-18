<?php
/**
 * General Boarding cards interface
 *
 * @package     Boarding Cards
 * @author      Mohamed Ibrahim <m.ibrahim@integrateddev.com>
 * @version     v.1.0 (08/11/2017)
 * @copyright   Copyright (c) 2016, Integrated Development
 */

namespace BoardingCards\Contracts;

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
     * @param $from
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
     *
     * @param $to
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