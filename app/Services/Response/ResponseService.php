<?php

namespace App\Services\Response;

use App\Models\Response;

class ResponseService
{
    public function storeResponse($data)
    {
        return Response::storeResponse($data);
    }
}
