<?php

namespace App\Transforms;

use App\Transforms\TransformInterface;

class TransformCreateManyHostsOscar implements TransformInterface
{
    public static function handle(array $data)
    {
        $result = [];

        foreach ($data["hosts"] as $hosted) {
            $result[] = ["name" => $hosted];
        }
        return $result;
    }
}
