<?php

namespace App\Entity\Api\Request;

use Symfony\Component\Validator\Constraints as Assert;

class RegisterResponse
{
    public string $token;
}
