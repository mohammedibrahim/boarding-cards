<?php
/**
 * Boarding Cards Main Class
 *
 * @package     Boarding Cards
 * @author      Mohamed Ibrahim <m.ibrahim@integrateddev.com>
 * @version     v.1.0 (08/11/2017)
 * @copyright   Copyright (c) 2016, Integrated Development
 */

namespace BoardingCards;

use BoardingCards\BoardingCardsTypes\BusBoardingCard;
use BoardingCards\BoardingCardsTypes\FlightBoardingCard;
use BoardingCards\BoardingCardsTypes\TrainBoardingCard;
use BoardingCards\Logic\SortingBoardingCards;
use BoardingCards\OutputFormats\StringOutputFormat;

include __DIR__ . '/vendor/autoload.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

/**
 * Main Class
 *
 * Class MainClass
 * @package BoardingCards
 */
class MainClass
{

    /**
     * MainClass constructor.
     */
    function __construct()
    {
        $boardingCards = new SortingBoardingCards();

        $boardingCards->addBoardingCard(FlightBoardingCard::instance()->createBoardingCard([
            'from' => 'Stockholm',
            'to' => 'New York JFK',
            'seat_number' => '7B',
            'transportation_number' => 'SK22',
            'gate_number' => '22',
            'baggage_details' => 'Baggage will we automatically transferred from your last leg',
        ]));

        $boardingCards->addBoardingCard(BusBoardingCard::instance()->createBoardingCard([
            'from' => 'Barcelona',
            'to' => 'Gerona Airport',
        ]));

        $boardingCards->addBoardingCard(FlightBoardingCard::instance()->createBoardingCard([
            'from' => 'Gerona Airport',
            'to' => 'Stockholm',
            'seat_number' => '3A',
            'transportation_number' => 'SK455',
            'gate_number' => '45B',
            'baggage_details' => 'Baggage drop at ticket counter 344',
        ]));

        $boardingCards->addBoardingCard(TrainBoardingCard::instance()->createBoardingCard([
            'from' => 'Madrid',
            'to' => 'Barcelona',
            'seat_number' => '45B',
            'transportation_number' => '78A'
        ]));

        $boardingCards->sort()->output(StringOutputFormat::instance("\n"));
    }

}

new MainClass();