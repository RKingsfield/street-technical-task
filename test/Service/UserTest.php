<?php

declare(strict_types=1);

namespace Test\Service;

use App\Model\User;
use App\Service\User as UserService;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class UserTest extends TestCase 
{

  #[DataProvider('provideTestCases')]
  public function testConvertStringToUsers(string $input, array $expectedOutput): void
  {
    $userService = new UserService();
    $this->assertEquals($expectedOutput, $userService->convertStringToUsers($input));
  }

  public static function provideTestCases(): array
  {
    return [
      ['Mr John Smith', [new User('Mr', 'Smith', firstName: 'John')]],
      ['Mrs Jane Smith', [new User('Mrs', 'Smith', firstName: 'Jane')]],
      ['Mister John Doe', [new User('Mr', 'Doe', firstName: 'John')]],
      ['Mr Bob Lawblaw', [new User('Mr', 'Lawblaw', firstName: 'Bob')]],
      ['Mr and Mrs Smith', [new User('Mr', 'Smith'), new User('Mrs', 'Smith')]],
      ['Mr Craig Charles', [new User('Mr', 'Charles', firstName: 'Craig')]],
      ['Mr M Mackie', [new User('Mr', 'Mackie', initial: 'M')]],
      ['Mrs Jane McMaster', [new User('Mrs', 'McMaster', firstName: 'Jane')]],
      ['Mr Tom Staff and Mr John Doe', [new User('Mr', 'Staff', firstName: 'Tom'), new User('Mr', 'Doe', firstName: 'John')]],
      ['Dr P Gunn', [new User('Dr', 'Gunn', initial: 'P')]],
      ['Dr & Mrs Joe Bloggs', [new User('Dr', 'Bloggs'), new User('Mrs', 'Bloggs', firstName: 'Joe')]], // would check what the expected output is here
      ['Ms Claire Robbo', [new User('Ms', 'Robbo', firstName: 'Claire')]],
      ['Prof Alex Brogan', [new User('Prof', 'Brogan', firstName: 'Alex')]],
      ['Mrs Faye Hughes-Eastwood', [new User('Mrs', 'Hughes-Eastwood', firstName: 'Faye')]],
      ['Mr F. Fredrickson', [new User('Mr', 'Fredrickson', initial: 'F')]]
    ];
  }
}