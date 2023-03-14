.. required styles !!
.. raw:: html

    <style> .block {color:lightgrey; font-size: 0.6em; display: block; align-items: center; background-color:black; width:8em; height:8em;padding-left:7px;} </style>
    <style> .tag0 {color:grey; font-size: 0.9em; font-family: "Courier New", monospace;} </style>
    <style> .tag3 {color:grey; font-size: 0.9em; display: inline-block; width:3.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag4 {color:grey; font-size: 0.9em; display: inline-block; width:4.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag5 {color:grey; font-size: 0.9em; display: inline-block; width:5.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag6 {color:grey; font-size: 0.9em; display: inline-block; width:6.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag7 {color:grey; font-size: 0.9em; display: inline-block; width:7.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag8 {color:grey; font-size: 0.9em; display: inline-block; width:8.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag9 {color:grey; font-size: 0.9em; display: inline-block; width:9.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag10 {color:grey; font-size: 0.9em; display: inline-block; width:10.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag11 {color:grey; font-size: 0.9em; display: inline-block; width:11.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tag12 {color:grey; font-size: 0.9em; display: inline-block; width:12.1ch; font-family: "Courier New", monospace;} </style>
    <style> .tagsign {color:grey; font-size: 0.9em; display: inline-block; width:3.2em;} </style>
    <style> .param {color:#005858; background-color:#F8F8F8; font-size: 0.8em; border:1px solid #D0D0D0;padding-left: 5px; padding-right: 5px;} </style>
    <style> .tech {color:#005858; background-color:#F8F8F8; font-size: 0.9em; border:1px solid #D0D0D0;padding-left: 5px; padding-right: 5px;} </style>

.. end required styles

.. required roles !!
.. role:: block
.. role:: tag0
.. role:: tag3
.. role:: tag4
.. role:: tag5
.. role:: tag6
.. role:: tag7
.. role:: tag8
.. role:: tag9
.. role:: tag10
.. role:: tag11
.. role:: tag12
.. role:: tagsign
.. role:: param
.. role:: tech

.. end required roles

.. _bhenk\doc2rst\globals\RC:

RC
==

.. table::
   :widths: auto
   :align: left

   ========== ============================================================== 
   namespace  bhenk\\doc2rst\\globals                                        
   predicates Final | Enum                                                   
   implements `UnitEnum <https://www.php.net/manual/en/class.unitenum.php>`_ 
   ========== ============================================================== 


**Holds key names for configuration of Container** :ref:`bhenk\doc2rst\globals\RunConfiguration`


.. contents::


----


.. _bhenk\doc2rst\globals\RC::Constants:

Constants
~~~~~~~~~


.. _bhenk\doc2rst\globals\RC::application_root:

RC::application_root
++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ================== 
   predicates public | enum case 
   ========== ================== 




**The source directory, usually indicated with names like** *src* **or** *application*


(string)


.. admonition:: For autoconfiguration:

   .. code-block::

      project_directory/application_root



| :tag4:`link` :ref:`bhenk\doc2rst\process\Constitution::autoFindApplicationRoot`



.. code-block:: php

   enum(bhenk\doc2rst\globals\RC::application_root) 




----


.. _bhenk\doc2rst\globals\RC::vendor_directory:

RC::vendor_directory
++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ================== 
   predicates public | enum case 
   ========== ================== 




**The vendor directory or first part of namespace**


(string)


.. admonition:: For autoconfiguration:

   .. code-block::

      project_directory/application_root/vendor_directory



| :tag4:`link` :ref:`bhenk\doc2rst\process\Constitution::autoFindVendor`



.. code-block:: php

   enum(bhenk\doc2rst\globals\RC::vendor_directory) 




----


.. _bhenk\doc2rst\globals\RC::doc_root:

RC::doc_root
++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ================== 
   predicates public | enum case 
   ========== ================== 




**The documentation directory; autoconfiguration is computed from this directory**



(string)


.. admonition:: For autoconfiguration:

   .. code-block::

      project_directory/doc_root





.. code-block:: php

   enum(bhenk\doc2rst\globals\RC::doc_root) 




----


.. _bhenk\doc2rst\globals\RC::api_directory:

RC::api_directory
+++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ================== 
   predicates public | enum case 
   ========== ================== 




**The directory for api-documentation**



(string)


.. admonition:: For autoconfiguration:

   .. code-block::

      project_directory/doc_root/api_directory





.. code-block:: php

   enum(bhenk\doc2rst\globals\RC::api_directory) 




----


.. _bhenk\doc2rst\globals\RC::api_docs_title:

RC::api_docs_title
++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ================== 
   predicates public | enum case 
   ========== ================== 




**Title of the root entry in the generated api-documentation**



(string)



.. code-block:: php

   enum(bhenk\doc2rst\globals\RC::api_docs_title) 




----


.. _bhenk\doc2rst\globals\RC::show_visibility:

RC::show_visibility
+++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ================== 
   predicates public | enum case 
   ========== ================== 





.. code-block:: php

   enum(bhenk\doc2rst\globals\RC::show_visibility) 




----


.. _bhenk\doc2rst\globals\RC::excludes:

RC::excludes
++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ================== 
   predicates public | enum case 
   ========== ================== 




**Array of (parts of) namespaces and classes to exclude from documentation**



(array)

To exclude complete branches, it is enough to exclude the root of that branch.
To exclude individual classes, the fully qualified name of the class should be given



.. code-block:: php

   enum(bhenk\doc2rst\globals\RC::excludes) 




----


.. _bhenk\doc2rst\globals\RC::log_level:

RC::log_level
+++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ================== 
   predicates public | enum case 
   ========== ================== 




**Level of logging during generation of documentation**



(int)

Log level expressed as int, interval 100:

..  code-block::

   error always, warning <= 400, notice <= 300, info <= 200, debug <= 100





.. code-block:: php

   enum(bhenk\doc2rst\globals\RC::log_level) 




----


.. _bhenk\doc2rst\globals\RC::toctree_max_depth:

RC::toctree_max_depth
+++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ================== 
   predicates public | enum case 
   ========== ================== 




**Max depth for the toctree directive**



(int)



.. admonition::  see also

    `toctree maxdepth <https://www.sphinx-doc.org/en/master/usage/restructuredtext/directives.html#directive-toctree>`_



.. code-block:: php

   enum(bhenk\doc2rst\globals\RC::toctree_max_depth) 




----


.. _bhenk\doc2rst\globals\RC::toctree_titles_only:

RC::toctree_titles_only
+++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ================== 
   predicates public | enum case 
   ========== ================== 




**Only document titles should show up in the toctree, not other headings**



(bool)



.. admonition::  see also

    `toctree titlesonly <https://www.sphinx-doc.org/en/master/usage/restructuredtext/directives.html#directive-toctree>`_



.. code-block:: php

   enum(bhenk\doc2rst\globals\RC::toctree_titles_only) 




----


.. _bhenk\doc2rst\globals\RC::show_class_contents:

RC::show_class_contents
+++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ================== 
   predicates public | enum case 
   ========== ================== 




**Should a table of contents appear at the top of the class documentation**



(bool)



.. code-block:: php

   enum(bhenk\doc2rst\globals\RC::show_class_contents) 




----


.. _bhenk\doc2rst\globals\RC::user_provided_links:

RC::user_provided_links
+++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ================== 
   predicates public | enum case 
   ========== ================== 




**User provided mapping of `namespace\\classname` to links that give access to documentation on these types**



Classes in external libraries cannot be linked to their documentation automatically.

(array)



.. code-block:: php

   enum(bhenk\doc2rst\globals\RC::user_provided_links) 




----


.. _bhenk\doc2rst\globals\RC::link_to_sources:

RC::link_to_sources
+++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ================== 
   predicates public | enum case 
   ========== ================== 




**If no documentation of `namespace\\classname` can be found, should a link to the (local) source file be provided**



Classes in external libraries can be linked to their local source files.

(bool)




.. code-block:: php

   enum(bhenk\doc2rst\globals\RC::link_to_sources) 




----


.. _bhenk\doc2rst\globals\RC::link_to_search_engine:

RC::link_to_search_engine
+++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ================== 
   predicates public | enum case 
   ========== ================== 




**If no documentation on `namespace\\classname` can be found, should a link to a search engine be provided**



The search engine url will have the `namespace\\classname` in the query parameter.

(bool)



.. code-block:: php

   enum(bhenk\doc2rst\globals\RC::link_to_search_engine) 




----


.. _bhenk\doc2rst\globals\RC::download_file_ext:

RC::download_file_ext
+++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ================== 
   predicates public | enum case 
   ========== ================== 





.. code-block:: php

   enum(bhenk\doc2rst\globals\RC::download_file_ext) 




----


.. _bhenk\doc2rst\globals\RC::show_datestamp:

RC::show_datestamp
++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ================== 
   predicates public | enum case 
   ========== ================== 





.. code-block:: php

   enum(bhenk\doc2rst\globals\RC::show_datestamp) 




----


.. _bhenk\doc2rst\globals\RC::Methods:

Methods
~~~~~~~


.. _bhenk\doc2rst\globals\RC::forName:

RC::forName
+++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


**Gets the enum case for the given name or** *null* **if it doesn't exist**





.. code-block:: php

   public static function forName(
         Parameter #0 [ <required> string $name ]
    ): ?RC


| :tag6:`param` string :param:`$name`
| :tag6:`return` ?\ :ref:`bhenk\doc2rst\globals\RC`


----


.. _bhenk\doc2rst\globals\RC::cases:

RC::cases
+++++++++

.. table::
   :widths: auto
   :align: left

   ========== ===================================================================== 
   predicates public | static                                                       
   implements `UnitEnum::cases <https://www.php.net/manual/en/unitenum.cases.php>`_ 
   ========== ===================================================================== 


.. code-block:: php

   public static function cases(): array


| :tag6:`return` array


----

:block:`no datestamp` 
