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
     * @return array
     */
    public function performRequest(
        string $method,
        string $request_url,
        array $form_params=[],
        array $headers=[]
    )
    {
        $client = new Client([
            "base_uri" => $this->base_uri,
        ]);

        if(isset($this->secret)) {
            $headers['Service-Authorization'] = $this->secret;
        }

        $response = $client->request($method, $request_url, [
            'form_params'   => $form_params,
            'headers'       => $headers,
            'http_errors' => false
        ]);

        $body = $response->getBody();

        return json_decode($body, true);
    }
}
