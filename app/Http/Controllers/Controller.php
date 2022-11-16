<?php

namespace App\Http\Controllers;

use App\Contracts\HasJsonResponse;
use App\Traits\JsonResponse;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController implements HasJsonResponse
{
    use JsonResponse;
}
