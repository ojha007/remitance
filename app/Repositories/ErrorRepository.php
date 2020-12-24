<?php


namespace App\Repositories;


use Illuminate\Support\Facades\Log;

class ErrorRepository
{

    public function logError(\Exception $exception, $id = null)
    {
        $edition = request()->segment(1);
        Log::error('-----Error-------' . $edition . '-----' . $id . '-----' .
            $exception->getMessage() . '--------' . $exception->getTraceAsString()
        );
    }

}
