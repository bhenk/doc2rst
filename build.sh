#!/usr/bin/env bash

B_RED="\E[1;41m"
B_LGRAY="\E[1;47m"
C_WHITE="\E[1;37m"
C_END="\E[0m "

function checkSuccess() {
  if [ $1 -eq 0 ]; then
      printf "$B_LGRAY $2 succeeded $C_END\n"
      printf "=============================================================\n"
  else
      printf "$B_RED$C_WHITE $2 failed $C_END\n"
      exit 1
  fi
}

phpunit --bootstrap application/unit/bootstrap.php application/unit
checkSuccess $? 'phpunit: PHPUnit tests'

./doc2rst.phar
checkSuccess $? "doc2rst: Generating reStructuredText"

sphinx-build -b html ./docs .docs/_build
checkSuccess $? "sphinx-build: Creating html"

php --define phar.readonly=0 create-phar.php
checkSuccess $? "create-phar: Build"