<?php
/**
 * Boarding Cards Sorter
 *
 * @package     Boarding Cards
 * @author      Mohamed Ibrahim <m.ibrahim@integrateddev.com>
 * @version     v.1.0 (08/11/2017)
 * @copyright   Copyright (c) 2016, Integrated Development
 */

namespace BoardingCards\Logic;

use BoardingCards\Contracts\GeneralBoardingCardAttributes;
use BoardingCards\Contracts\OutputFormat;
use BoardingCards\Exceptions\BoardingCardsException;

/**
 * Boarding Cards Sorter contains Logic of cards sorting.
 *
 * Class SortingBoardingCards
 * @package BoardingCards\Logic
 */
class SortingBoardingCards
{
    /**
     * Array contains boarding cards needs to be sorted.
     *
     * @var array
     */
    protected $_boardingCards = [];

    /**
     * Add Boarding Cards.
     *
     * @param GeneralBoardingCardAttributes $boardingCards
     * @return $this
     */
    public function addBoardingCard(GeneralBoardingCardAttributes $boardingCards)
    {
        $this->_boardingCards[] = $boardingCards;

        return $this;
    }

    /**
     * Get Boarding Cards.
     *
     * @return array
     */
    public function getBoardingCards()
    {
        return $this->_boardingCards;
    }

    /**
     * Sort Boarding Cards.
     *
     * @return $this
     * @throws BoardingCardsException
     */
    public function sort()
    {
        if (empty($this->_boardingCards)) {
            throw new BoardingCardsException('You must add at least one boarding card!');
        }

        $sortedBoardingCards = [];

        $max = count($this->_boardingCards) * count($this->_boardingCards);

        $loopIndex = 0;

        while (!empty($this->_boardingCards) && $loopIndex < $max) {

            foreach ($this->_boardingCards as $index => $boardingCard) {

                if (empty($sortedBoardingCards)) {

                    $sortedBoardingCards[] = $boardingCard;
                    unset($this->_boardingCards[$index]);
                    continue;
                }

                $fromCity = $boardingCard->getFrom();
                $toCity = $boardingCard->getTo();

                $lastSortedToCity = end($sortedBoardingCards)->getTo();
                $firstSortedFromCity = reset($sortedBoardingCards)->getFrom();

                //Put the card at the end of the array.
                if ($fromCity == $lastSortedToCity) {

                    $sortedBoardingCards[] = $boardingCard;
                    unset($this->_boardingCards[$index]);
                    continue;
                }

                //Put the Card at the first of array.
                if ($toCity == $firstSortedFromCity) {

                    array_unshift($sortedBoardingCards, $boardingCard);
                    unset($this->_boardingCards[$index]);
                    continue;
                }

            }

            $loopIndex++;
        }

        if (!empty($this->_boardingCards) && $loopIndex >= $max) {
            throw new BoardingCardsException('You missed to enter one or more boarding cards!');
        }

        $this->_boardingCards = $sortedBoardingCards;

        return $this;
    }

    /**
     * Return boarding cards as string.
     *
     * @param OutputFormat $format
     * @param bool $echo
     * @return string
     * @throws BoardingCardsException
     */
    public function output(OutputFormat $format, $echo = true)
    {
        if (empty($this->_boardingCards)) {
            throw new BoardingCardsException('You must add at least one boarding card!');
        }

        $boardingCardsToStrings = [];

        foreach ($this->_boardingCards as $boardingCard) {
            $boardingCardsToStrings[] = $boardingCard->output($format);
        }

        $boardingCardsToStrings[] = 'You have arrived at your final destination.';

        $output = $format->allCardsFormat($boardingCardsToStrings);

        if (!$echo) {
            return $output;
        }

        echo $output;
    }
}
