<?php

namespace App\Traits;

trait CommonTrait
{
    /**
     * Get keys from the fetched db data.
     */
    public function getKeysFromExtractedData($data)
    {
        if ($data->isEmpty()) return $data;
        
        $response = $data->first();
        return array_keys($response->toArray());
    }
}
