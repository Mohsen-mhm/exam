<?php

namespace App\Http\Controllers\SMS;

use App\Http\Controllers\Controller;
use App\Services\SMS\SMS;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function sendSMS(Request $request)
    {
        $phone = $request->input('phone');
        SMS::sendPattern($phone);
        return response()->json(['status' => 'success', 'phone' => $phone]);
    }
}
