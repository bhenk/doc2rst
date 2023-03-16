#!/usr/bin/env bash

cd ../ || exit 1
./doc2rst.phar
sphinx-build -b html ./docs ./docs/_build