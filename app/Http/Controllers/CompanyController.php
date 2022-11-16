<?php

namespace App\Http\Controllers;

use App\Facades\CompanyControlFacade;
use App\Http\Requests\CompanyRequest;
use Illuminate\Http\JsonResponse;


class CompanyController extends Controller
{
    /**
     * @param CompanyRequest $request
     * @return JsonResponse
     */
    public function create(CompanyRequest $request): JsonResponse
    {
        return $this->apiOk(CompanyControlFacade::createCompany($request->all()));
    }

    /**
     * @return JsonResponse
     */
    public function companies(): JsonResponse
    {
        return $this->apiOk(CompanyControlFacade::getCompanies());
    }
}
