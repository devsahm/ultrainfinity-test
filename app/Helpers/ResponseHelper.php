<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;


use function array_replace;

class ResponseHelper
{
    /**
     * @param string|array $response
     * @param int          $status
     * @return Response
     */
    public static function build($response, $status)
    {
        return response()->json($response, $status);
    }

    /**
     * @param string|array $response
     * @param int          $status
     * @return Response
     */
    public static function success($response, $status = Response::HTTP_OK)
    {
        $buildableResponse = ['status' => 'success', 'data' => $response];

        if ($response instanceof JsonResource && $response->resource instanceof Paginator) {
            $buildableResponse = array_replace($buildableResponse, (array) $response->toResponse(request())->getData());
        }

        return static::build($buildableResponse, $status);
    }

    /**
     * @param string|array $response
     * @param int          $status
     * @return Response
     */
    public static function fail($response, $status = 422)
    {
        $response = (array) $response;
        $response = Arr::flatten($response);
        $response = $response[0] ?? 'An error occured. Please try again.';

        return static::build([
            'status'  => 'error',
            'message' => $response,
        ], $status);
    }
}
