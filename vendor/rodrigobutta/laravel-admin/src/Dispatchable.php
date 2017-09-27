<?php

namespace RodrigoButta\Admin;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Dispatchable
{


    /**
     * Get ajax response.
     *
     * @param string $message
     *
     * @return bool|\Illuminate\Http\JsonResponse
     */
    protected function ajaxResponse($message)
    {
        $request = Request::capture();

        // ajax but not pjax
        if ($request->ajax() && !$request->pjax()) {
            return response()->json([
                'status'  => true,
                'message' => $message,
            ]);
        }

        return false;
    }



}
