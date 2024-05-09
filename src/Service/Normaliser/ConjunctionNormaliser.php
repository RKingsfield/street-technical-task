<?php
namespace App\Service\Normaliser;

class ConjunctionNormaliser extends AbstractNormaliser
{
  protected $mappings = [
    'and' => '&'

  ];

  public function normalise(string $string): string
  {
    $normalisedString = $this->lcwords($string);
    foreach ($this->mappings as $key => $value) {
      $normalisedString = str_replace(" $key ", " $value ", $normalisedString);
    }

    return ucwords(ucwords($normalisedString), '-');
  }
}
