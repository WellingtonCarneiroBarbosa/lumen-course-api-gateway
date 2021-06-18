<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait ApiResponse
{
    /**
     * The default sucess message
     *
     * @var string
     */
    private $default_sucess_message = "";

    /**
     * Returns a response
     *
     * @param object|array $data
     * @param integer $code
     * @param string $message
     * @return \Illuminate\Http\Response
     */
    public function response($data, string $message = null, int $code = 200)
    {
        return response([
            "data"      => $data,
            "message"   => $message ?? $this->default_sucess_message,
            "status"    => $code,
        ], $code)->header('Content-Type', 'application/json');
    }

    /**
     * Mount a response from internal service response data
     *
     * @param array $internal_service_response
     *
     * @return \Illuminate\Http\Response
     */
    protected function responseFromInternalService(array $internal_service_response)
    {
        return $this->response(
            $internal_service_response['data'],
            $internal_service_response['message'],
            $internal_service_response['status'],
        );
    }
}
