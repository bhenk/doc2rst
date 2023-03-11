<?php

namespace bhenk\doc2rst\globals;

use Exception;
use Psr\Container\NotFoundExceptionInterface;

/**
 * @inheritDoc
 * @inheritDoc
 */
class NotFoundException extends Exception implements NotFoundExceptionInterface {
}