.. raw:: html

   <style> .tech {color:#005858; background-color:#F8F8F8; font-size: 0.9em; border:1px solid #D0D0D0;padding-left: 5px; padding-right: 5px;} </style>
   <style> .tag6 {color:grey; font-size: 0.9em; display: inline-block; width:6.1ch; font-family: "Courier New", monospace;} </style>
   <style> .param {color:#005858; background-color:#F8F8F8; font-size: 0.8em; border:1px solid #D0D0D0;padding-left: 5px; padding-right: 5px;} </style>

.. role:: tech
.. role:: tag6
.. role:: param

Configuration
=============

.. contents::

.. _run_configuration:

d2r-conf.php
++++++++++++

The run configuration file is set up as an array. You can find the :term:`d2r-conf.php` in your :term:`doc_root` folder
after running :term:`quickstart`. Keys in the array correspond to the names of enum cases in the UnitEnum
:ref:`bhenk\doc2rst\globals\RC`.

Example :term:`d2r-conf.php`:

.. code-block::

   <?php

   return array(
       'application_root' => '/abs/path/to/project/src',
       'vendor_directory' => '/abs/path/to/project/src/Acme',
       'bootstrap_file' => '/abs/path/to/project/docs/bootstrap.php',
       'doc_root' => '/abs/path/to/project/docs',
       'api_directory' => '/abs/path/to/project/docs/api',
       'api_docs_title' => 'api-docs',
       'show_visibility' => ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_PROTECTED,
       'excludes' =>
           array(
              "Acme\package04",
              "Acme\package01\package02\NotInDocsClass.php"
           ),
       'log_level' => 200,
       'toctree_max_depth' => 0,
       'toctree_titles_only' => true,
       'show_class_contents' => true,
       'user_provided_links' =>
           array(
               "Psr\Container" => "https://www.php-fig.org/psr/psr-11/"
           ),
       'link_to_sources' => false,
       'link_to_search_engine' => true,
       'download_file_ext' =>
           array(
               '.txt',
               '.csv',
               '.js',
               '.sql',
           ),
       'show_datestamp' => true,
   );

See :ref:`bhenk\doc2rst\globals\RC` for a detailed discussion of options.

d2r-order.php
+++++++++++++

:term:`d2r-order.php` determines the layout of your PHPDoc comments in the final documentation. You can find the
:term:`d2r-order.php` in your :term:`doc_root` folder after running :term:`quickstart`. Keys in the array
are names of tags and names of elements of a PhpDocComment.

Example :term:`d2r-order.php`:

.. code-block::

   <?php

   /**
    * Gives the order of elements in DocComments.
    */
   return [
       "@api" => "",
       "@deprecated" => "warning",
       "@internal" => "danger",
       "@todo" => "admonition",
       "@generated" => "",
       "summary" => "",
       "description" => "",
       "@inheritdoc" => "admonition",
       "@since" => "",
       "unknown_tags" => "",
       "@uses" => "",
       "@link" => "",
       "@see" => "admonition see also",
       "@package" => "",
       "@version" => "",
       "@author" => "",
       "@copyright" => "",
       "@license" => "",
       "@method" => "",
       "@var" => "",
       "signature" => "",
       "@param" => "",
       "@return" => "",
       "@throws" => "",
   ];

As said before, the order of the elements in the final documentation is determined by the order in which they
appear in :term:`d2r-order.php`. Apart from all the tag names starting with :tech:`@`,
there are 4 other keys in the above array:
*summary*, *description*, *unknown_tags* and *signature*.

Element names
-------------

Here is a short description of what these element names signify.

* summary
   First line of your PhpDocComment
   (up to the first dot :tech:`.` or empty line) and will be printed fat. In the above example
   it is not the first element. For instance the *@deprecated* tag is before it. It might be convenient for
   your readers to see that a method or class is deprecated before they start reading the complete
   description and at the end find the method or class is deprecated.
* description
   Rest of your PhpDocComment
   including inline tags. (Inline tags are surrounded with curly braces: :tech:`{@inheritdoc}`).
* unknown_tags
   Tag names found in your PhpDocComments that do not appear in the :term:`d2r-order.php`. These tags are
   listed in the final documentation at the specified place. For instance in the above they are listed
   between the :tech:`@since` and the :tech:`@uses` tags.

   By the way, you can specify the order (and layout)
   of any tag by just incorporating them as key => value in :term:`d2r-order.php`.
   Fi :tech:`"@myTag" => "admonition very important!"` will appear as such in the documentation.
* signature
   Signature of member. This is a signature:

   .. code-block:: php

      public static abstract function enumForName(
            Parameter #0 [ <required> string $id ]
       ): ?UnitEnum

If you leave out any of the above element name keys, they wil not be printed in the final documentation.
The value of element name keys is of no importance; they wil not influence their layout.

Tag names
---------

Tag names in :term:`d2r-order.php` do not only specify where they appear in the final documentation; the value
given determines their layout.

An empty string signifies *no special layout*. :tech:`"@param" => ""`:

:tag6:`param` string :param:`$line` - line to format

Given one of the
`Specific Admonitions <https://docutils.sourceforge.io/docs/ref/rst/directives.html#specific-admonitions>`_
the tag will be rendered as such. :tech:`"@deprecated" => "warning"`:

.. warning::

    **@deprecated** 1.0.1 Use alternative method

The special *admonition* directive with no further name specified will take the tag name as title.
:tech:`"@todo" => "admonition"`:

.. admonition:: @todo

    Explain the function of this method

Given a title it will be rendered as shown below. Example: :tech:`"@see" => "admonition see also"`:

.. admonition::  see also

    `rtd for a detailed explanation <https://doc2rst.readthedocs.io/en/latest/index.html>`_

d2r-styles.txt
++++++++++++++

:term:`d2r-styles.txt` is placed in your :term:`doc_root` folder after running :term:`quickstart`. It contains
some style elements used by doc2rst. You can alter them as you please.

* .block
   style of the datetime stamp at the end of each page
* .tag0
   style of inline tag names
* .tag3 - tag12
   style of tags as they are displayed in groups. Determines the width of the column.
