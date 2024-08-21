<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PassportController extends Controller
{
    public function __invoke(Request $request)
    {
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
