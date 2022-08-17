<?php

namespace App\Http\Traits;
use Illuminate\Http\Request;

trait ResponseTrait
{


    public function response(Array $data, $status = 200, $headers = [])
    {
        return response()->json($data, $status, $headers);
    }
}
