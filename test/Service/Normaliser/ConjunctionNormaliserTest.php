<?php

declare(strict_types=1);

namespace Test\Service\Normaliser;

use PHPUnit\Framework\TestCase;
use App\Service\Normaliser\ConjunctionNormaliser;
use PHPUnit\Framework\Attributes\DataProvider;

class ConjunctionNormaliserTest extends TestCase
{
  #[DataProvider('provideTestCases')]
  public function testNormailsesConjunctions(string $input, string $expectedOutput): void
  {
    $conjunctionNormaliser = new ConjunctionNormaliser();
    $this->assertEquals($expectedOutput, $conjunctionNormaliser->normalise($input));
  }

  public static function provideTestCases(): array
  {
    return [
      ['Mr Tom Staff and Mr John Doe', 'Mr Tom Staff & Mr John Doe'],
      ['Mr Tom Staff And Mr John Doe', 'Mr Tom Staff & Mr John Doe']
    ];
  }
}