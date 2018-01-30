<?php
/**
 * Boarding Cards Sorter testing cases
 *
 * @package     Boarding Cards
 * @author      Mohamed Ibrahim <m.ibrahim@integrateddev.com>
 * @version     v.1.0 (08/11/2017)
 * @copyright   Copyright (c) 2016, Integrated Development
 */

namespace BoardingCards\Tests;

use BoardingCards\BoardingCardsTypes\BusBoardingCard;
use BoardingCards\BoardingCardsTypes\FlightBoardingCard;
use BoardingCards\BoardingCardsTypes\TrainBoardingCard;
use BoardingCards\Exceptions\BoardingCardsException;
use BoardingCards\Logic\SortingBoardingCards;
use BoardingCards\OutputFormats\StringOutputFormat;
use PHPUnit\Framework\TestCase;

/**
 * Boarding Cards Testing Cases
 *
 * @covers Sorting Tests.
 */
final class SortingBoardingCardsTest extends TestCase
{

    /**
     * Test if one or more tickets are missing!
     */
    public function testValidateErrors()
    {
        $this->expectException(BoardingCardsException::class);

        $this->expectExceptionMessage('You missed to enter one or more boarding cards!');

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

        $boardingCards->addBoardingCard(TrainBoardingCard::instance()->createBoardingCard([
            'from' => 'Madrid',
            'to' => 'Barcelona',
            'seat_number' => '45B',
            'transportation_number' => '78A'
        ]));

        $boardingCards->sort();

    }

    /**
     * Test Empty Boarding Cards
     */
    public function testEmptyBoardingCards()
    {
        $this->expectException(BoardingCardsException::class);

        $this->expectExceptionMessage('You must add at least one boarding card!');

        $boardingCards = new SortingBoardingCards();

        $boardingCards->sort();
    }

    /**
     * Test Boarding Cards parameters is array.
     */
    public function testAddedBoardingCardsParametersMustBeArray()
    {
        $this->expectException(
            'TypeError'
        );

        $boardingCards = new SortingBoardingCards();

        $boardingCards->addBoardingCard(FlightBoardingCard::instance()->createBoardingCard('dasdasd'));
    }

    /**
     * Test Boarding Cards array isn't empty
     */
    public function testAddedBoardingCardsParametersArrayIsNotEmpty()
    {
        $this->expectException(BoardingCardsException::class);

        $this->expectExceptionMessage('Boarding Card Information are missing!');

        $boardingCards = new SortingBoardingCards();

        $boardingCards->addBoardingCard(FlightBoardingCard::instance()->createBoardingCard([]));
    }

    /**
     * Test Boarding Cards array elements have values
     */
    public function testAddedBoardingCardsParametersArrayEachItemHasValue()
    {
        $keyWithEmptyValue = 'from';

        $this->expectException(BoardingCardsException::class);

        $this->expectExceptionMessage($keyWithEmptyValue . ' must have a value!');

        $boardingCards = new SortingBoardingCards();

        $boardingCards->addBoardingCard(FlightBoardingCard::instance()->createBoardingCard([
            $keyWithEmptyValue => '',
            'to' => 'Barcelona'
        ]));
    }

    /**
     * Test Boarding Cards array elements is correct.
     */
    public function testAddedBoardingCardsParametersArrayKeysIsCorrect()
    {
        $wrongKey = 'from_city';

        $this->expectException(BoardingCardsException::class);

        $this->expectExceptionMessage($wrongKey . ' isn\'t a valid boarding card option!');

        $boardingCards = new SortingBoardingCards();

        $boardingCards->addBoardingCard(FlightBoardingCard::instance()->createBoardingCard([
            'from' => 'Stockholm',
            'to' => 'New York JFK',
            'seat_number' => '7B',
            'transportation_number' => 'SK22',
            'gate_number' => '22',
            'baggage_details' => 'Baggage will we automatically transferred from your last leg',
            $wrongKey => 'Stockhom',
        ]));
    }

    /**
     * Test Sorting Results
     */
    public function testSortingResult()
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

        $result = $boardingCards->sort()->getBoardingCards();

        $fromCity = $result[0]->getFrom();
        $secondCity = $result[1]->getFrom();
        $thirdCity = $result[2]->getFrom();
        $fourthCity = $result[3]->getFrom();
        $lastCity = $result[3]->getTo();

        $this->assertEquals($fromCity, 'Madrid');
        $this->assertEquals($secondCity, 'Barcelona');
        $this->assertEquals($thirdCity, 'Gerona Airport');
        $this->assertEquals($fourthCity, 'Stockholm');
        $this->assertEquals($lastCity, 'New York JFK');
    }

    /**
     * Test String result Output as text.
     */
    public function testValidateSortingResultOutputAsString()
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

        $result = $boardingCards->sort()->output(StringOutputFormat::instance(), false);

        $this->assertEquals(
            $result, "Take train 78A from Madrid to Barcelona. Sit in seat 45B.
Take the airport bus from Barcelona to Gerona Airport. No seat assignment.
From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, Seat 3A, Baggage drop at ticket counter 344.
From Stockholm, take flight SK22 to New York JFK. Gate 22, Seat 7B, Baggage will we automatically transferred from your last leg.
You have arrived at your final destination.
"
        );
    }

}