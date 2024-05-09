<?php
namespace App\Model;

use JsonSerializable;

class User implements JsonSerializable
{

  public string $title;
  public string $lastName;
  public ?string $initial;
  public ?string $firstName;

  public function __construct(string $title, string $lastName, ?string $initial = null, ?string $firstName = null)
  {
    $this->title = $title;
    $this->lastName = $lastName;
    $this->initial = $initial;
    $this->firstName = $firstName;
  }

  public function jsonSerialize(): array
  {
    return [
      "title" => $this->title,
      "initial" => $this->initial,
      "firstName" => $this->firstName,
      "lastName" => $this->lastName
    ];
  }
}