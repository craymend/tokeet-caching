<?php

namespace Craymend\TokeetSdk\DataFeed;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Inquiries extends DataFeedBase
{
    /**
     * Get bookings within the next 2 years of provided start date for the provided rental
     * 
     * Note:
     * "...extract detailed, event-level data from Tokeet"
     * 
     * Note 2:
     * "Data feed URLs can provide no more than 1000 records at a time. 
     *    If your data feed has more than 1000 available records please utilize 
     *    the skip and limit options found under Edit URL to create multiple 
     *    URLs that account for the entire data set, or use the filter options 
     *    to decrease the filter range."
     * 
     * https://www.tokeet.com/help/data-feeds/tokeet-data-feeds
     * 
     * @param string $rentalPKey
     * @param string $startDate 'Y-m-d'
     * @return stdObject
     */
    public function getRentalBookings($rentalPKey, $startDate=null)
    {
        // Tokeet DataFeeds require dates to be in 'm-d-Y' format 
        $ymdStartDate = (is_null($startDate)) ? date('Y-m-d') : $ymdStartDate = date('Y-m-d', strtotime($startDate));
        $startDate = (is_null($startDate)) ? date('m-d-Y') : $startDate = date('m-d-Y', strtotime($startDate));
        $endDate = date('m-d-Y', strtotime('+2 year', strtotime($ymdStartDate)));

        $url = "?booked=1&rental=$rentalPKey&start=$startDate&end=$endDate";

        $curOptions = $this->options;

        $client = new Client([
            'base_uri' => $this->baseUrl
        ]);

        try{
            $response = $client->request('GET', $url, $curOptions);

            $body = (string) $response->getBody();

            if(str_contains($body, '"data" : "No entries found."')){
                $data = [];
            }else{
                $data = $this->csvStrToArray($body);
            }

            return (object) [
                'code' => $response->getStatusCode(),
                'message' => $response->getReasonPhrase(),
                'data' => $data,
                'status' => 'success',
                'url' => $this->baseUrl . $url
            ];
        }catch(GuzzleException $e){
            return (object) [
                'error' => $e->getMessage(),
                'status' => 'fail'
            ];
        }
    }
}