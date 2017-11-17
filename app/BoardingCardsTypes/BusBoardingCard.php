<?php namespace BoardingCards\BoardingCardsTypes;

/**
 * Bus Boarding card class.
 *
 * Class AbstractBoardingCards
 * @package BoardingCards\BoardingCardsTypes
 */
class BusBoardingCard extends AbstractBoardingCard
{
    /**
     * Output Boarding Card Text to string.
     *
     * @return mixed
     */
    public function outputToString()
    {
        return sprintf(
            'Take the airport bus from %s to %s. No seat assignment.',
            $this->getFrom(),
            $this->getTo()
        );
    }
}