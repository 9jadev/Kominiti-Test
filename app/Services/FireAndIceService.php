<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;

class FireAndIceService  {
    public function fetchBook($name = ""){
        try {
            logs()->info(config('fireandice.url')."?name=$name");
            logs()->info("Calling Fire And Ice");
            $response = Http::get(config('fireandice.url')."?name=$name");
            if ($response->ok()) {
                logs()->info($response);
                return $response->json();
            }
        } catch (\Throwable $th) {
            //throw $th;
            logs()->info($th);
            return null;
        }

    }
}
