<?php
namespace App\handlers;


interface HandlerInterface
{
    public function process(int $payload):int;
}
