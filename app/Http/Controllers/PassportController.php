<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    private const EXPECTED_KEYS = ['registration_number', 'online_id'];

    public function __invoke(Request $request)
    {
        if(array_diff(array_keys($request->all()), self::EXPECTED_KEYS)) {
            return $this->respondError('Invalid parameter(s)');
        }

        $validated = $request->validate([
            'registration_number' => ['required_without:online_id', 'string', 'regex:/^EBSU\-\d{4}\-\d{4,6}[A-Z]?$/'],
            'online_id' => ['required_without:registration_number', 'string', 'regex:/^[0-9]+$/'],
        ]);

        return $this->filterPassport();
    }

    private function filterPassport()
    {
        return new JsonResponse(
            data: ["data" => "lorem ipsum", "status" => true, "message" => "success"],
        );
    }
}
