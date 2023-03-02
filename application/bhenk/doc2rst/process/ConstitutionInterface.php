<?php

namespace bhenk\doc2rst\process;

/**
 * Implementations of this interface set and/or check runtime configuration.
 */
interface ConstitutionInterface {

    const CONFIGURATION_FILENAME = "d2r-conf.php";
    const STYLES_FILENAME = "d2r-styles.txt";

    /**
     * Set and/or check runtime configuration.
     *
     * @return void
     */
    public function establishConfiguration(): void;

}