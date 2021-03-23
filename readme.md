# Tokeet Caching

[![Software License][ico-license]](LICENSE)


Query Tokeet API for Rentals and Tokeet Data Feeds for additional information including current bookings.

## Installation

Via composer.<br/>
Add the following to your composer.json
```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/craymend/tokeet-caching.git"
    }
],
"require": {
    "craymend/tokeet-caching": "dev-master"
},
```
```
composer update
```

Now in your .env file, define your Tokeet credentials:
```php
TOKEET_API_KEY=<your Tokeet API key/email>
TOKEET_ACCOUNT=<your Tokeet Account ID>
TOKEET_INQUIRY_DATA_FEED_BASE_URL=<your Tokeet data feed url>
```
## Rental API Usage Example
use Craymend\TokeetSdk\Api\Rentals;

$queryObj = new Rentals();
$response = $queryObj->getRentals();
if($response->status === 'success'){
    $rentals = $response->data;

    foreach($rentals as $rental){
        echo "$rental->name \n";
    }
}

## Data Feed Booking Example
[Laravel task scheduling](https://laravel.com/docs/5.5/scheduling) makes it easy to update cached data.
use Craymend\TokeetSdk\DataFeed\Inquiries;

$queryObj = new Inquiries();
$response = $queryObj->getRentalBookings($rental->pkey, $startDate);

 if($response->status === 'success'){
    $bookingsCsvArray = $response->data;

    for($i = 0; $i < count($bookingsCsvArray); $i++){
        if($i == 0){
            continue; // ignore name row
        }

        $row = $bookingsCsvArray[$i];
        $bookingId = $row[8];
        $name = $row[0];

        echo "$bookingId - $name \n";
    }
 }

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.



[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square