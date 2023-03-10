<?php

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\DocState;
use bhenk\doc2rst\globals\RunConfiguration;
use function array_diff;
use function file_exists;
use function is_dir;
use function scandir;

class DocScout {

    public function scanDocs(): void {
        if (!file_exists(RunConfiguration::getApiDirectory())) return;
        DocState::setPreRun(true);
        $this->scanDirectories(RunConfiguration::getApiDirectory());
    }

    private function scanDirectories(string $dir): void {
        $files = array_diff(scandir($dir, SCANDIR_SORT_ASCENDING), array("..", ".", ".DS_Store"));
        foreach ($files as $file) {
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            if (is_dir($path)) {
                DocState::addAbsoluteDir($path);
                $this->scanDirectories($path);
            } else {
                DocState::addAbsoluteFile($path);
            }
        }
    }

}