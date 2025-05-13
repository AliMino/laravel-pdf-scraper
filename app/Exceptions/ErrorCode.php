<?php

namespace App\Exceptions;

enum ErrorCode: int {

    case Unknown             = 0;

    case InvalidInputs       = 1;

    case EntityNotFound      = 2;

    case EntityAlreadyExists = 3;

    case InvalidCredentials  = 4;
}
