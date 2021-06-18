<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesInternalServices
{
    /**
     * Send a request to any service
     *
     * @param string $method
     * @param string $request_url
     * @param array $form_params
     * @param array $headers
     *
     * @return string
     */
    public function performRequest(
        string $method,
        string $request_url,
        array $form_params=[],
        array $headers=[]
    )
    {
        return (new Client([
            "base_uri" => $this->base_uri,
        ]))->request($method, $request_url, [
            'form_params'   => $form_params,
            'headers'       => $headers,
        ])->getBody();
    }
}
