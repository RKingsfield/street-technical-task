<?php
namespace App\Service\Normaliser;

abstract class Normaliser
{

  abstract public function normalise(string $string): string;

}