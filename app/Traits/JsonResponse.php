<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse as HttpJsonResponse;

trait JsonResponse
{
    /**
     * @param mixed $data
     * @return HttpJsonResponse
     */
    public function apiOk($data): HttpJsonResponse
    {
        return response()->json(['success' => true, 'response' => $data]);
    }

    /**
     * @param mixed $data
     * @param int $status
     * @return HttpJsonResponse
     */
    public function apiFail($data, int $status): HttpJsonResponse
    {
        return response()->json(['success' => false, 'errors' => $data],$status);
    }
}
