<?php

namespace bhenk\doc2rst\globals;

use Exception;
use Psr\Container\ContainerExceptionInterface;

/**
 * @inheritDoc
 */
class ContainerException extends Exception implements ContainerExceptionInterface {
}