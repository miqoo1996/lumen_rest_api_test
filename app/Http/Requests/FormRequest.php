<?php

namespace App\Http\Requests;

use App\Contracts\HasJsonResponse;
use App\Traits\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class FormRequest implements HasJsonResponse
{
    use ProvidesConvenienceMethods, JsonResponse;

    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->process();
    }

    public function __get(string $name)
    {
        return $this->request->get($name);
    }

    public function __set(string $name, $value)
    {
        return $this->request->$name = $value;
    }

    public function __call($name, $arguments)
    {
        return $this->request->$name(...$arguments);
    }

    public function process() : void
    {
        $this->prepareForValidation();

        if (!$this->authorize()) {
            throw new UnauthorizedException;
        }

        $this->validate($this->request, $this->rules(), $this->messages(), []);
    }

    protected function authorize(): bool
    {
        return true;
    }

    protected function rules(): array
    {
        return [];
    }

    protected function messages(): array
    {
        return [];
    }

    protected function prepareForValidation(): void
    {

    }
}
