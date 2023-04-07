<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\SMS\SMS;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SmsController extends Controller
{
    public function sendSMS(Request $request)
    {
        try {
            $phone = "+" . $request->input('country_code') . $request->input('phone');
            SMS::sendPattern($phone);

            return $this->response(true, 'SMS send successfully.', [
                'phone' => $phone,
            ], Response::HTTP_OK);

        } catch (\Exception $exception) {
            return $this->response(false, $exception->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
