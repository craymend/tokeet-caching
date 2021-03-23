<?php

namespace Craymend\TokeetSdk\Api;

class ApiBase
{
    function __construct($options) {
        $this->account = config('tokeet-sdk.account');
        $this->apiKey = config('tokeet-sdk.key');
        $this->baseUrl = 'https://capi.tokeet.com/v1/';

        // used to set query options
        $this->options = $options;
    }
}