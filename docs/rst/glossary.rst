.. raw:: html

   <style> .tech {color:#005858; background-color:#F8F8F8; font-size: 0.9em; border:1px solid #D0D0D0;padding-left: 5px; padding-right: 5px;} </style>

.. role:: tech

Glossary
========

.. glossary::

   application_root
      Configuration option. Absolute path to the source directory, usually indicated with names
      like *src* or *application*.

      .. admonition:: see also

         :ref:`bhenk\doc2rst\globals\RC::application_root`

   api_directory
      Configuration option. Absolute path to the directory for api-documentation. doc2rst will
      populate this directory with generated rst-files.

      .. admonition:: see also

         :ref:`bhenk\doc2rst\globals\RC::api_directory`

   bootstrap_file
      Configuration option. File needed to be able to load your classes.
      When using composer can be as simple as

      .. code-block::

         <?php

         require_once "path/to/your/vendor/autoload.php";

   d2r-conf.php
      Configuration file. This file, with suggestions for configuration, will be placed
      in the :term:`doc_root` directory after running
      :ref:`ProcessManager::quickStart <bhenk\doc2rst\process\ProcessManager::quickStart>`.

      .. admonition:: see also

         | :ref:`RC for detailed information<bhenk\doc2rst\globals\RC>` about configuration options.
         | :ref:`run_configuration`

   d2r-order.php
      Configuration file. This file, with suggestions for configuration, will be placed
      in the :term:`doc_root` directory after running
      :ref:`ProcessManager::quickStart <bhenk\doc2rst\process\ProcessManager::quickStart>`.

   d2r-styles.txt
      Configuration file. This file holds some style information and will be ingested
      at the top of each generated rst-document. It will be placed in the
      :term:`doc_root` directory after running
      :ref:`ProcessManager::quickStart <bhenk\doc2rst\process\ProcessManager::quickStart>`.

   doc2rst.phar
      Executable phar-file. Convenient way to generate reStructuredText files for your
      project documentation. Download **doc2rst.phar** from
      `github releases <https://github.com/bhenk/doc2rst/releases>`_. Install
      preferably in your project root folder. On a commandline execute

      .. code-block::

         $ ./doc2rst.phar -h

      for help on options and arguments.

   doc_root
      Configuration option. Absolute path to the directory for documentation aka *docs*.

      .. admonition:: see also

         :ref:`bhenk\doc2rst\globals\RC::doc_root`

   package documentation page
      For each directory encountered in the source tree a package documentation file
      will be generated. The contents of any :term:`package.rst` file found in this
      directory will be integrated in the :term:`package documentation page`.
      It further displays links to classes, php-files and/or packages found
      in this directory. If files, other than php-files, are made downloadable the
      :term:`package documentation page` will have download links to these files.


   package.rst
      File in a source directory in reStructuredText format. If such a file is encountered
      it will be included in the :term:`package documentation page`. A package.rst file can be as simple
      as carrying one line: **The summary of the package**, describing in short the purpose
      of the package.

      .. hint::
         It is also possible to add individual files to the **downloads** section of the
         package documentation page. In order to accomplish this just add an entry

         .. code-block::

            .. download {file_name}

         on a new line to the :term:`package.rst` file of that package.

   quickstart
      Doc2rst run mode that initiates configuration files in the :term:`doc_root` folder, scans the source tree
      and does best guesses for configuration options. In this mode doc2rst will *not* generate
      reStructuredText files. Run quickstart with doc2rst.phar in your project root folder:

      .. code-block::

         $ ./doc2rst.phar -q ./docs

      .. admonition:: see also

         :ref:`bhenk\doc2rst\process\ProcessManager::quickStart`

   run
      Doc2rst run mode wherein the actual work is done: generating documentation from your source tree.
      Run with doc2rst.phar in your project root folder:

      .. code-block::

         $ ./doc2rst.phar -r ./docs

      .. admonition:: see also

         :ref:`bhenk\doc2rst\process\ProcessManager::run`

   vendor_directory
      Configuration option. Absolute path to the directory that is usually one directory
      further than the :term:`application_root` or source directory.

      .. admonition:: see also

         :ref:`bhenk\doc2rst\globals\RC::vendor_directory`
