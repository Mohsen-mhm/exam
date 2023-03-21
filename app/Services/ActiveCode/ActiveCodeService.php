<?php

namespace App\Services\ActiveCode;

use App\Models\ActiveCode;

class ActiveCodeService
{
    public function checkCodeIsTrue($enteredCode, $user)
    {
        return ActiveCode::checkCodeIsTrue($enteredCode, $user);
    }

    public function checkExpirationIsValid($user)
    {
        return ActiveCode::checkExpirationIsValid($user);
    }

    public function deleteCode($user)
    {
        return ActiveCode::deleteCode($user);
    }
}
