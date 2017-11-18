# Boarding Card Sorter

<!-- TOC depthFrom:1 depthTo:6 withLinks:1 updateOnSave:1 orderedList:0 -->
- [Description](#description)
- [Installation](#installation)
- [How To use](#how-to-use)
- [New Transportation Type](#new-transportation-type)
- [New Boarding Card Attribute](#new-boarding-card-attribute)
- [New Output Format](#new-output-format)
- [PHP Docs](#php-docs)
- [Test Cases](#test-cases)
<!-- /TOC -->

## Description
You are given a stack of boarding cards for various transportation that will take you from a point
A to point B via several stops on the way. All of the boarding cards are out of order and you don't
know where your journey starts, nor where it ends. Each boarding card contains information
about seat assignment, and means of transportation (such as flight number, bus number etc).

## Installation
Using composer :

```
git clone http://github.com/mohammedibrahim/boarding-cards.git
cd boarding-cards
composer install
php index.php
```

## How To use
To enter the details of the boarding cards.

```
$boardingCards = new SortingBoardingCards();

//Flight Boarding Card
$boardingCards->addBoardingCard(FlightBoardingCard::instance()->createBoardingCard([
    'from' => 'Stockholm',
    'to' => 'New York JFK',
    'seat_number' => '7B',
    'transportation_number' => 'SK22',
    'gate_number' => '22',
    'baggage_details' => 'Baggage will we automatically transferred from your last leg',
]));

//Bus Boarding Card
$boardingCards->addBoardingCard(BusBoardingCard::instance()->createBoardingCard([
    'from' => 'Barcelona',
    'to' => 'Gerona Airport',
]));

// Flight Boarding Card
$boardingCards->addBoardingCard(FlightBoardingCard::instance()->createBoardingCard([
    'from' => 'Gerona Airport',
    'to' => 'Stockholm',
    'seat_number' => '3A',
    'transportation_number' => 'SK455',
    'gate_number' => '45B',
    'baggage_details' => 'Baggage drop at ticket counter 344',
]));

//Train Boarding Card
$boardingCards->addBoardingCard(TrainBoardingCard::instance()->createBoardingCard([
    'from' => 'Madrid',
    'to' => 'Barcelona',
    'seat_number' => '45B',
    'transportation_number' => '78A'
]));

//Sort Cards and output as string
$boardingCards->sort()->output(StringOutputFormat::instance());
```

## New Transportation Type
You may need to create a new boarding card.

Go to 

```
boarding-cards -> app -> BoardingCardsTypes
```

Create a new class

```
<?php namespace BoardingCards\BoardingCardsTypes;

/**
 * New Transportation Boarding card class.
 *
 * Class AbstractBoardingCards
 * @package BoardingCards\BoardingCardsTypes
 */
class NewTransportationCard extends AbstractBoardingCard
{
    /**
     * Output Boarding Card Text to string.
     *
     * @return mixed
     */
    public function outputToString()
    {
        // Return text to be added.
        return 'Text';
    }
}
```

By default Each New Transportation Card has a default attributes 

```
'from' => 'Barcelona',
'to' => 'Gerona Airport',
```

To add new attribute like seat_number and transportation_number, You must implement it's interfaces.

```
<?php namespace BoardingCards\BoardingCardsTypes;

use BoardingCards\Contracts\SeatableBoardingCardAttributes;
use BoardingCards\Contracts\TransportationNumberBoardingCardAttributes;

/**
 * New Transportation Boarding card class.
 *
 * Class AbstractBoardingCards
 * @package BoardingCards\BoardingCardsTypes
 */
class NewTransportationCard extends AbstractBoardingCard implements
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
     * @return mixed
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
     * @return mixed
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
        // Return text to be added.
        return 'Text';
    }
}
```
Available custom attributes for boarding cards is 
```
//Baggage Details
//'baggage_details' => 'Baggage will we automatically transferred from your last leg',

BoardingCards\Contracts\BaggageBoardingCardAttributes;

// Gate Number
//'gate_number' => '22',

BoardingCards\Contracts\GateBoardingCardAttributes;

//Seat Number
//'seat_number' => '7B',

BoardingCards\Contracts\SeatableBoardingCardAttributes;

// Trasportation Number eg. Train No. 45
//'transportation_number' => 'SK22',

BoardingCards\Contracts\TransportationNumberBoardingCardAttributes;
```

## New Boarding Card Attribute

To create a new custom attribute for a boarding card

Go to 

```
boarding-cards -> app -> Contracts
```

Create a new interface

```
<?php namespace BoardingCards\Contracts;
/**
 * Custom Borading card attribute.
 *
 * Interface SeatableBoardingCards
 * @package BoardingCards\Contracts
 */
Interface CustomBoardingCardAttribute {

    /**
     * Set Seat Number.
     *
     * @return mixed
     */
    public function setCustomAttribute($customAttribute);
    /**
     * Must Return Seat number
     *
     * @return mixed
     */
    public function getCustomAttribute();
}
```

Implement it to your boarding card class
```
<?php namespace BoardingCards\BoardingCardsTypes;

use BoardingCards\Contracts\SeatableBoardingCardAttributes;
use BoardingCards\Contracts\TransportationNumberBoardingCardAttributes;
use BoardingCards\Contracts\CustomBoardingCardAttribute;

/**
 * New Transportation Boarding card class.
 *
 * Class AbstractBoardingCards
 * @package BoardingCards\BoardingCardsTypes
 */
class NewTransportationCard extends AbstractBoardingCard implements
     SeatableBoardingCardAttributes,
     TransportationNumberBoardingCardAttributes,
     CustomBoardingCardAttribute
{
    /**
     * Appended Defaults for boarding cards attributes
     *
     * @var array
     */
    protected $_appendedDefaults = [
        'seat_number' => '',
        'transportation_number' => '',
        'custom_boarding_card_attribute' => '';
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
     * Transportation Number.
     *
     * @var
     */
    protected $_customBoardingCardAttribute;
    
    /**
     * Set Seat Number.
     *
     * @return mixed
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
     * @return mixed
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
     * Set Custom Boarding Card Attribute.
     *
     * @return mixed
     */
    public function setCustomBoardingCardAttribute($customBoardingCardAttribute)
    {
        $this->_customBoardingCardAttribute = $customBoardingCardAttribute;

        return $this;
    }

    /**
     * Must Return Seat number
     *
     * @return mixed
     */
    public function getCustomBoardingCardAttribute()
    {
        return $this->_customBoardingCardAttribute;
    }
    
    /**
     * Output Boarding Card Text to string.
     *
     * @return mixed
     */
    public function outputToString()
    {
        // Return text to be added.
        return 'Text';
    }
}
```

To call New created boarding card
```
NewTransportationCard::instance()->createBoardingCard([
    'from' => 'Stockholm',
    'to' => 'New York JFK',
    'seat_number' => '7B',
    'transportation_number' => 'SK22',
    'custom_boarding_card_attribute' => 'Custom Text Value for new custom attribute',
])
```

##New Output Format
To create a new change the output format
 
Go to
```
OutputFormater
```
Create a new class that extend AbstractStringOutputFormat class and implement OutputFormat interface
 
```
/**
 * New output format.
 *
 * Class NewOutputFormat
 * @package BoardingCards\OutputFormats
 */
class NewOutputFormat extends AbstractStringOutputFormat implements OutputFormat
{
    /**
     * Format boarding card output
     *
     * @param $data
     * @return mixed
     */
    public function format($data)
    {
        // output the result as you wish.
    }
}
```

To use it
```
$boardingCards->sort()->output(NewOutputFormat::instance());
```

## PHP Docs

To View php docs 

Go to 
```
http://[your_app_url]/docs/index.html
```

To Update docs 

At app root directory Run

```
php vendor/bin/phpdoc -d app/ -t docs --title="Boarding Cards Sorter"
```

## Test Cases

To Run test cases. From app root directory

Run

```
php vendor/bin/phpunit app/Tests/SortingBoardingCardsTest.php --testdox
```