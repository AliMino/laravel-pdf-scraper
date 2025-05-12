<?php

namespace App\Exceptions\API;

use App\Exceptions\ErrorCode;

use Illuminate\Http\JsonResponse;

use Exception;
use Throwable;

abstract class APIException extends Exception {

    protected function __construct(
        
        public readonly int             $statusCode = 500,
                        string          $message    = "",
                        int|ErrorCode   $code       = ErrorCode::Unknown,
                        ?Throwable      $previous   = null
    ) {

        $code = is_int( $code ) ? $code : $code->value;
        
        parent::__construct($message, $code, $previous);
    }

    public final function toJsonResponse(): JsonResponse {

        return response()->json(
            [ 'status'  => false ] + $this->toArray(),
            $this->statusCode
        );
    }

    public function toArray(): array {
        
        return [

            'message' => $this->getMessage(),
            'code'    => $this->getCode(),
        ];
    }
}
