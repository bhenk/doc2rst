#!/usr/bin/env bash

B_RED="\E[1;41m"
B_GRAY="\E[1;47m"
B_GREEN="\E[1;42m"
C_WHITE="\E[1;97m"
C_END="\E[0m "

function checkSuccess() {
  if [ "$1" -eq 0 ]; then
    printf "$B_GRAY %s $B_GREEN$C_WHITE = success!   $C_END\n\n" "$2"
  else
    printf "$B_RED$C_WHITE %s = failure!   $C_END\n" "$2"
    exit 1
  fi
}

phpunit --bootstrap application/unit/bootstrap.php application/unit
checkSuccess $? "phpunit: PHPUnit tests              "

./doc2rst.phar
checkSuccess $? "doc2rst: Generating reStructuredText"

sphinx-build -b html ./docs ./docs/_build/html
checkSuccess $? "sphinx-build: Creating html         "

php --define phar.readonly=0 create-phar.php
checkSuccess $? "create-phar: Build                  "
