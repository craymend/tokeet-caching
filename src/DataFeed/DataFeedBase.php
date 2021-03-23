<?php

namespace Craymend\TokeetSdk\DataFeed;

class DataFeedBase
{
    function __construct($options) {
        $this->baseUrl = config('tokeet-sdk.inquiry_data_feed_base_url');

        // used to set query options
        $this->options = $options;
    }

    /**
     * @param string $csvStr
     * @return Array
     */
    public function csvStrToArray($csvStr){
        $lines = explode("\n", $csvStr);

        $array = [];
        foreach ($lines as $line) {
            $newLine = str_getcsv($line);

            if(!is_null($newLine) && !is_null($newLine[0])){
                $array[] = $newLine;
            }

        }
        
        return $array;
    }
}