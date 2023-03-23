<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ShortLinkApi
{
    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public static function getShortLink(string $link):string
    {
        $client = new Client(["base_uri" => "https://api.shrtco.de/v2/"]);
        $response = $client->request("POST", "shorten?url=$link");

        $result = json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);
        return $result->result->short_link;
    }
}
