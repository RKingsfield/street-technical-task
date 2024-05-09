<?php

declare(strict_types=1);

namespace Test\Service\Normaliser;

use PHPUnit\Framework\TestCase;
use App\Service\Normaliser\ConjunctionNormaliser;

class ConjunctionNormaliserTest extends TestCase
{
  public function getTestCases(): array
  {
    return [
      'Mr Tom Staff and Mr John Doe' => 'Mr Tom Staff & Mr John Doe',
      'Mr Tom Staff And Mr John Doe' => 'Mr Tom Staff & Mr John Doe'
    ];
  }

  public function testConjunctionNormaliser(): void
  {
    $titleNormaliser = new ConjunctionNormaliser();
    foreach($this->getTestCases() as $input => $expectedOutput) {
      $this->assertEquals($expectedOutput, $titleNormaliser->normalise($input));
    }
  }
}