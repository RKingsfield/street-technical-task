<?php

declare(strict_types=1);

namespace Test\Service\Normaliser;

use PHPUnit\Framework\TestCase;
use App\Service\Normaliser\TitleNormaliser;

class TitleNormaliserTest extends TestCase 
{
  public function getTestCases(): array
  {
    return [
      'Mister John Doe' => 'Mr John Doe',
      'Missus Jane Doe' => 'Mrs Jane Doe',
      'Miss Jane Doe' => 'Ms Jane Doe',
      'Doctor Jamie Doe' => 'Dr Jamie Doe',
      'Professor Jamie Doe' => 'Prof Jamie Doe',
    ];
  }

  public function testTitleNormaliser(): void
  {
    $titleNormaliser = new TitleNormaliser();
    foreach($this->getTestCases() as $input => $expectedOutput) {
      $this->assertEquals($expectedOutput, $titleNormaliser->normalise($input));
    }
  }
}