<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use JsonSerializable;
use Symfony\Component\HttpFoundation\Response;

trait ApiHelpers
{
    public function respondNotFound(
        ?string $message,
    ): JsonResponse {
        return $this->apiResponse(
            data: [
                'status' => false,
                'error' => $message ?? 'Not found',
            ],
            code: Response::HTTP_NOT_FOUND
        );
    }

    public function respondWithSuccess(
        array|Arrayable|JsonSerializable|null $data = null,
        ?string $message = null,
    ): JsonResponse {
        $dataArray = ['status' => true];

        if ($message) {
            $dataArray['message'] = $message;
        }

        if ($data) {
            $dataArray['data'] = $data;
        }

        return $this->apiResponse(
            data: $dataArray,
            code: Response::HTTP_OK,
        );
    }

    public function respondOk(?string $message = null): JsonResponse
    {
        return $this->apiResponse(
            data: [
                'status' => true,
                'message' => $message ?? 'Ok',
            ],
            code: Response::HTTP_OK
        );
    }

    public function respondUnAuthorized(?string $message = null): JsonResponse
    {
        return $this->apiResponse(
            data: [
                'status' => false,
                'error' => $message ?? 'Unauthorized',
            ],
            code: Response::HTTP_UNAUTHORIZED
        );
    }

    public function respondForbidden(?string $message = null): JsonResponse
    {
        return $this->apiResponse(
            data: [
                'status' => false,
                'error' => $message ?? 'Forbidden',
            ],
            code: JsonResponse::HTTP_FORBIDDEN
        );
    }

    public function respondError(?string $message = null): JsonResponse
    {
        return $this->apiResponse(
            data: [
                'status' => false,
                'error' => $message ?? 'Error',
            ],
            code: Response::HTTP_BAD_REQUEST
        );
    }

    public function respondMethodNotAllowed(?string $message = null): JsonResponse
    {
        return $this->apiResponse(
            data: [
                'status' => false,
                'error' => $message ?? 'Method not allowed',
            ],
            code: Response::HTTP_METHOD_NOT_ALLOWED
        );
    }

    public function respondCreated(
        array|Arrayable|JsonSerializable|null $data = null,
        ?string $message = null,
    ): JsonResponse {
        return $this->apiResponse(
            data: [
                'status' => true,
                'message' => $message ?? 'Resource created successfully!',
                'data' => $data ?? [],
            ],
            code: Response::HTTP_CREATED
        );
    }

    public function respondFailedValidation(
        ?string $message,
    ): JsonResponse {
        return $this->apiResponse(
            data: [
                'status' => false,
                'error' => $message ?? 'Validation error',
            ],
            code: Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    public function respondTeapot(): JsonResponse
    {
        return $this->apiResponse(
            data: [
                'status' => false,
                'error' => 'I\'m a teapot',
            ],
            code: Response::HTTP_I_AM_A_TEAPOT
        );
    }

    public function respondNoContent(): JsonResponse
    {
        return $this->apiResponse(
            data: ['status' => true],
            code: Response::HTTP_NO_CONTENT
        );
    }

    private function apiResponse(array $data, ?int $code): JsonResponse
    {
        return new JsonResponse(
            data: $data,
            status: $code ?? Response::HTTP_OK
        );
    }
}