<?php
namespace App\Service\Normaliser;

abstract class AbstractNormaliser
{
  abstract public function normalise(string $string): string;

  protected function lcwords($words) {
    return implode(' ', array_map(function($e) { return lcfirst($e); }, explode(' ', $words)));
  }
}