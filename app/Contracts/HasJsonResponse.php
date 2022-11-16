<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse as HttpJsonResponse;

interface HasJsonResponse
{
    /**
     * @param mixed $data
     * @return HttpJsonResponse
     */
    public function apiOk($data): HttpJsonResponse;

    /**
     * @param mixed $data
     * @param int $status
     * @return HttpJsonResponse
     */
    public function apiFail($data, int $status): HttpJsonResponse;
}
