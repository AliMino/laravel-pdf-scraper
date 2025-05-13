<?php

namespace App\Exceptions;

enum ErrorCode: int {

    case Unknown                = 0;

    case InvalidInputs          = 1;

    case EntityNotFound         = 2;

    case EntityAlreadyExists    = 3;

    case InvalidCredentials     = 4;

    case UserNotAuthenticated   = 5;
    
    case UnauthorizedAccess     = 6;
    
    case UrlScanInProgress      = 7;
    
    case InvalidUrlScanStatus   = 8;
}
