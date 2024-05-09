<?php

declare(strict_types=1);

namespace Test\Service\Normaliser;

use PHPUnit\Framework\TestCase;
use App\Service\Normaliser\TitleNormaliser;
use PHPUnit\Framework\Attributes\DataProvider;

class TitleNormaliserTest extends TestCase 
{
  
  #[DataProvider('provideTestCases')]
  public function testNormalisesTitle(string $input, string $expectedOutput): void
  {
    $titleNormaliser = new TitleNormaliser();
    $this->assertEquals($expectedOutput, $titleNormaliser->normalise($input));
  }

  public static function provideTestCases(): array
  {
    return [
      ['Mister John Doe', 'Mr John Doe'],
      ['Missus Jane Doe', 'Mrs Jane Doe'],
      ['Miss Jane Doe', 'Ms Jane Doe'],
      ['Doctor Jamie Doe', 'Dr Jamie Doe'],
      ['Professor Jamie Doe', 'Prof Jamie Doe'],
    ];
  }
}