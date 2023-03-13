<?php

namespace App\Transformers;

class TransformCreateManyCuriosities implements TransformInterface
{

    public static function handle(array $data)
    {
        $result = [];

        foreach ($data["curiosities"] as $curiosity) {
            array_push($result, ["content" => $curiosity]);
        }
        return $result;
    }
}
