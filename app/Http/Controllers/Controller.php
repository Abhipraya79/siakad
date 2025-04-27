<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Helper untuk merespon JSON dengan format standar.
     */
    protected function respondSuccess($data = [], string $message = 'OK')
    {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'    => $data,
        ]);
    }
}
