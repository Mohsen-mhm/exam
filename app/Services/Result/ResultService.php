<?php

namespace App\Services\Result;

use App\Models\Result;

class ResultService
{
    public function storeResult($data)
    {
        return Result::storeResult($data);
    }
}
