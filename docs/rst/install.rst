Quick Install
=============

.. contents::

Requirements
++++++++++++

Minimum (tested) PHP-version is 8.1.

Project structure
+++++++++++++++++

Doc2rst has several configuration options but in general expects a project structure that consists of
directories in a *project home* folder. The :term:`application_root` is where the php-source code is. The
:term:`doc_root` is where the documentation on the project goes. A direct child of the :term:`application_root`
folder is the :term:`vendor_directory`. Usually the name of this folder is also the start of the namespace sequence.
The :term:`doc_root` has a sub folder where the generated API-documents go: the :term:`api_directory`.

.. code-block::

   {project-home} |
                  | {application_root} |
                  |                    | {vendor_directory} |
                  |                                         | {package}
                  |                                         | {...}
                  | {doc_root} |
                               | {api_directory}

The :term:`vendor_directory` can have as many *packages* or sub folders as you like. All *packages* will have their
own entry in the table of contents on the start page of the api-documentation.

.. caution::

   Other project-structures may or may not work for doc2rst. They simply aren't tested.

Installing doc2rst as PHAR
++++++++++++++++++++++++++

Download the latest version of doc2rst as a PHAR-file
from `github <https://github.com/bhenk/doc2rst/releases>`_ and preferably place it in the root folder,
aka your *project home*. See instructions on running the doc2rst phar on the next page.

Installing doc2rst with composer
++++++++++++++++++++++++++++++++

As you probably only need doc2rst during development you can add the *--dev* option to the
composer command:

.. code-block::

   composer require --dev bhenk/doc2rst

See instructions on running doc2rst from code on the next page.
