<?php

namespace App\Traits;

trait OscarMessages
{
    private static array $messages = [
        "success" => [
            "create" => "Oscar has been registered.",
            "get" => "Oscar was found successfully",
            "update" => "Oscar has been updated.",
            "delete" => "Oscar has been deleted."
        ],
        "error" => [
            "get" => [
                "notFoundModel" => "Not found oscars on the year %s",
            ]
        ],
        "update" => [
            "OscarQueryEditionException" => "Oscar ceremony already exists with edition name: %s",
            "OscarQueryDateException" => "Oscar ceremony already exists with date a year: %s"
        ],
    ];
}
