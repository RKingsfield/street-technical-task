<?php
namespace App\Service\Normaliser;

class TitleNormaliser extends AbstractNormaliser
{
  protected $mappings = [
    'mister' => 'mr',
    'missus' => 'mrs',
    'miss' => 'ms',
    'doctor' => 'dr',
    'professor' => 'prof',
  ];

  public function normalise(string $string): string
  {
    $normalisedString = $this->lcwords($string);
    foreach ($this->mappings as $key => $value) {
      $normalisedString = str_replace("$key ", "$value ", $normalisedString);
    }

    return ucwords(ucwords($normalisedString, '-'));
  }
}
