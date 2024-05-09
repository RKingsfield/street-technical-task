<?php
namespace App\Service;

use App\Service\Normaliser\ConjunctionNormaliser;
use App\Service\Normaliser\TitleNormaliser;
use App\Service\Normaliser\Normaliser;
use App\Model\User as UserModel;

class User
{

  /** @var Normaliser[] */
  public array $normalisers;

  public function __construct()
  {
    $this->normalisers = [
      new ConjunctionNormaliser(),
      new TitleNormaliser()
    ];
  }

  /**
   * @return User[]
   */
  public function convertStringToUsers(string $userString): array
  {
    foreach ($this->normalisers as $normaliser) {
      $userString = $normaliser->normalise($userString);
    }

    $tokens = preg_split('/\s+/', $userString);
    // Fetch last name first, in case it is shared between both people
    $sharedLastName = array_pop($tokens);

    return array_map(function (string $string) use ($sharedLastName) {
      // @todo this could be tidier
      $tokens = preg_split('/\s+/', trim($string));

      $initial = null;
      $title = array_shift($tokens);
      $firstName = rtrim((array_shift($tokens) ?? ''), '.');
      $lastName = array_shift($tokens);

      if (strlen($firstName) === 1) {
        $initial = $firstName;
        $firstName = null;
      }

      return new UserModel(
        $title,
        $lastName ?? $sharedLastName,
        $initial,
        empty($firstName) ? null : $firstName,
      );
    }, explode('&', implode(' ', $tokens))); // Split this up into different people

  }
}