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

.. _bhenk\doc2rst\process\ProcessManager:

ProcessManager
==============

.. table::
   :widths: auto
   :align: left

   ========== ======================== 
   namespace  bhenk\\doc2rst\\process  
   predicates Cloneable | Instantiable 
   ========== ======================== 


**Runs the transformation of source files to restructured text files**


.. contents::


----


.. _bhenk\doc2rst\process\ProcessManager::Constructor:

Constructor
~~~~~~~~~~~


.. _bhenk\doc2rst\process\ProcessManager::__construct:

ProcessManager::__construct
+++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


**Constructs a new ProcessManager**


| The parameter :term:`doc_root` is the absolute path to the documentation directory.
| Optional parameter *$root* is the parent directory of main.php.




.. admonition::  see also

    :ref:`RC for runtime configuration options <bhenk\doc2rst\globals\RC>`


.. code-block:: php

   public function __construct(
         Parameter #0 [ <required> string $doc_root ]
         Parameter #1 [ <optional> ?string $root = NULL ]
    )


| :tag5:`param` string :param:`$doc_root` - The documentation directory; autoconfiguration is computed from this directory.
| :tag5:`param` ?\ string :param:`$root` - Optional. Parent directory of main.php


----


.. _bhenk\doc2rst\process\ProcessManager::Methods:

Methods
~~~~~~~


.. _bhenk\doc2rst\process\ProcessManager::quickStart:

ProcessManager::quickStart
++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Quickstart doc2rst**


This function will scan the source directory known as :term:`vendor_directory`.
It will not generate rst-files, only suggest reasonable configuration options for
file and directory paths.
Furthermore, it will place configuration files in the :term:`doc_root` directory.
These configuration files are:

* :term:`d2r-conf.php` - run configuration
* :term:`d2r-order.php` - order of DocComment segments and tag display
* :term:`d2r-styles.txt` - some extra css-styles used by doc2rst



.. code-block:: php

   public function quickStart(): void


| :tag6:`return` void


----


.. _bhenk\doc2rst\process\ProcessManager::run:

ProcessManager::run
+++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Run doc2rst and generate rst-files**



If nothing goes wrong you will find api-documentation in the :term:`api_directory` folder under
your :term:`doc_root` directory.



.. admonition::  see also

    :ref:`RC for runtime configuration options <bhenk\doc2rst\globals\RC>`


.. code-block:: php

   public function run(): void


| :tag6:`return` void


----


.. _bhenk\doc2rst\process\ProcessManager::getConstitution:

ProcessManager::getConstitution
+++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Autoconfiguration is done by an implementation of** :ref:`bhenk\doc2rst\process\ConstitutionInterface`



At the moment
there is only one implementation: :ref:`bhenk\doc2rst\process\Constitution`. If necessary write your own Constitution!



.. code-block:: php

   public function getConstitution(): ConstitutionInterface


| :tag6:`return` :ref:`bhenk\doc2rst\process\ConstitutionInterface`


----


.. _bhenk\doc2rst\process\ProcessManager::setConstitution:

ProcessManager::setConstitution
+++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Sets the Constitution used for autoconfiguration**





.. code-block:: php

   public function setConstitution(
         Parameter #0 [ <required> bhenk\doc2rst\process\ConstitutionInterface $constitution ]
    ): void


| :tag6:`param` :ref:`bhenk\doc2rst\process\ConstitutionInterface` :param:`$constitution`
| :tag6:`return` void


----

:block:`no datestamp` 
