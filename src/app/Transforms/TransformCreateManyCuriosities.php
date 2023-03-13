<?php

namespace App\Transforms;

use App\Transforms\TransformInterface;

class TransformCreateManyCuriosities implements TransformInterface
{

    public static function handle(array $data): array
    {
        $result = [];

        foreach ($data["curiosities"] as $curiosity) {
            $result[] = ["content" => $curiosity];
        }
        return $result;
    }
}
