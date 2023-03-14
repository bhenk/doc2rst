.. raw:: html

   <style> .tech {color:#005858; background-color:#F8F8F8; font-size: 0.9em; border:1px solid #D0D0D0;padding-left: 5px; padding-right: 5px;} </style>

.. role:: tech

Glossary
========

.. glossary::

   package documentation file
      For each directory encountered in the source tree a :term:`package documentation file`
      will be generated. The contents of any :term:`package.rst` file found in this
      directory will be integrated in the :term:`package documentation file`.
      It further caries links to classes, php-files and/or packages found
      in this directory. If files, other than php-files, are made downloadable the
      :term:`package documentation file` will cary download links to these files.


   package.rst
      File in a source directory in reStructuredText format. If such a file is encountered
      it will be included in the :term:`package documentation file`. A package.rst file can be as simple
      as carrying one line: **The summary of the package**, describing in short the purpose
      of the package.

      .. hint::
         It is also possible to add individual files to the **downloads** section of the
         package documentation page. In order to accomplish this just add an entry

         .. code-block::

            .. download {file_name}

         on a new line to the :term:`package.rst` file of that package.