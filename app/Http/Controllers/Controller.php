<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    /**
     * Success response method.
     */
    public function sendResponse($result, $message = '', $code = 200)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    /**
     * Error response method.
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    /**
     * Redirect with success message
     */
    public function redirectWithSuccess($route, $message)
    {
        return redirect()->route($route)->with('success', $message);
    }

    /**
     * Redirect with error message
     */
    public function redirectWithError($route, $message)
    {
        return redirect()->route($route)->with('error', $message);
    }

    /**
     * Redirect back with success message
     */
    public function backWithSuccess($message)
    {
        return redirect()->back()->with('success', $message);
    }

    /**
     * Redirect back with error message
     */
    public function backWithError($message)
    {
        return redirect()->back()->with('error', $message);
    }
}