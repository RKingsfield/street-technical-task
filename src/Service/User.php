<?php
namespace App\Service;

use App\Service\Normaliser\ConjunctionNormaliser;
use App\Service\Normaliser\TitleNormaliser;
use App\Service\Normaliser\NormaliserInterface;
use App\Model\User as UserModel;
use Slim\Psr7\UploadedFile;

class User
{

  /** @var NormaliserInterface[] */
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
  public function processCSVFile(UploadedFile $uploadedFile): array
  {
    $users = [];
    $file = $uploadedFile->getStream()->detach();

    fgetcsv($file, 10000, ","); // skip header
    while (($userString = fgetcsv($file, 10000, ",")) !== false) {
        $users = array_merge($users, $this->convertStringToUsers($userString[0]));
    }

    return $users;
  }

  /**
   * @return User[]
   */
  public function convertStringToUsers(string $userString): array
  {
    foreach ($this->normalisers as $normaliser) {
      $userString = $normaliser->normalise($userString);
    }

    $words = preg_split('/\s+/', $userString);
    $sharedLastName = array_pop($words);

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
    }, explode('&', implode(' ', $words)));

  }
}