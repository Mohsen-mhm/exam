<?php

namespace App\Services\SMS;

use App\Models\ActiveCode;
use Error;
use Illuminate\Support\Str;
use IPPanel\Client;
use IPPanel\Errors\HttpException;
use IPPanel\Errors\ResponseCodes;

class SMS
{
    public static function generateVerificationCode()
    {
        $code = mt_rand(100000, 999999);
        return $code;
    }

    public static function storeCode()
    {
        $code = self::generateVerificationCode();

        return ActiveCode::storeCode($code);
    }

    public static function sendPattern($phone)
    {
        $activeCode = self::storeCode();
        $client = new Client(env('FARAZ_SMS_API'));
        $lineNumber = '+983000505';
        $userNumber = $phone;

        $patternVariables = [
            "verification-code" => $activeCode->code,
        ];

        try {
            $messageId = $client->sendPattern(
                "f9vd3px82g1dr6c",    // pattern code
                $lineNumber,      // originator
                $userNumber,  // recipient
                $patternVariables,  // pattern values
            );
        } catch (Error $e) { // ippanel error
            var_dump($e->unwrap()); // get real content of error
            echo $e->getCode();

            // error codes checking
            if ($e->code() == ResponseCodes::ErrUnprocessableEntity) {
                echo "Unprocessable entity";
            }
        } catch (HttpException $e) { // http error
            var_dump($e->getMessage()); // get stringified error
            echo $e->getCode();
        }
    }
}
