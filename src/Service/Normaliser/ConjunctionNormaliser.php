<?php
namespace App\Service\Normaliser;

class ConjunctionNormaliser extends Normaliser
{
  protected $mappings = [
    'and' => '&'

  ];

  public function normalise(string $string): string
  {
    $normalisedString = strtolower($string);
    foreach ($this->mappings as $key => $value) {
      $normalisedString = str_replace(" $key ", " $value ", $normalisedString);
    }

    return ucwords(ucwords($normalisedString), '-');
  }
}
