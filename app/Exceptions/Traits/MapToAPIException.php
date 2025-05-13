<?php

namespace App\Exceptions\Traits;

use App\Exceptions\API\APIException;
use App\Exceptions\API\UnknownException;
use App\Exceptions\Attributes\ExceptionMapper;

use ReflectionClass;
use Throwable;

trait MapToAPIException {

    public final function render($request, Throwable $exception) {

        dump(get_class($exception) . ': ' . $exception->getMessage());
        if ($exception instanceof APIException) {

            return $exception->toJsonResponse();
        }

        if (is_null($mapperMethodName = $this->getMapperMethodName($exception))) {

            throw new UnknownException();
        }

        throw $this->$mapperMethodName($exception, $request);
    }

    private function getMapperMethodName(Throwable $exception): ?string {

        foreach ((new ReflectionClass($this))->getMethods() as $method) {

            if (!count($method->getAttributes(ExceptionMapper::class))) {

                continue;
            }

            $exceptionParameter = $method->getParameters()[0] ?? null;

            if (is_a($exception, $exceptionParameter?->getType()->getName())) {

                return $method->getName();
            }
        }

        return null;
    }
}
