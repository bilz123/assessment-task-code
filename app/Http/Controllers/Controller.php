<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return JSON/Ajax response for web app
     *
     * @return string
     */
    public function jsonResponse($data, $status = 200)
    {
        $status = is_int($status) && $status > 99 ? $status : 500;

        if (method_exists($data, 'errors')) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $data->errors()
            ], $status);
        }

        if (is_array($data) && !($status >= 200 && $status < 300)) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $data
            ], $status);
        }

        return response()->json($data, $status);
    }
}
