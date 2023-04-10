<?php

namespace App\Repositories\Contracts;

interface ReadOnlyInterface
{
    public function update(string $id, array $data):void;
    public function delete(string $id):void;
}
