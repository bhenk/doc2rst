<?php

namespace bhenk\doc2rst\process;

/**
 * Implementations of this interface set and/or check runtime configuration.
 */
interface ConstitutionInterface {

    /**
     * Set and/or check runtime configuration.
     *
     * @return void
     */
    public function establishConfiguration(): void;

}