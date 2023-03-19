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

.. _bhenk\doc2rst\process\SourceScout:

SourceScout
===========

.. table::
   :widths: auto
   :align: left

   ========== ======================== 
   namespace  bhenk\\doc2rst\\process  
   predicates Cloneable | Instantiable 
   ========== ======================== 


.. contents::


----


.. _bhenk\doc2rst\process\SourceScout::Constructor:

Constructor
+++++++++++


.. _bhenk\doc2rst\process\SourceScout::__construct:

SourceScout::__construct
------------------------

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


.. code-block:: php

   public function __construct()



----


.. _bhenk\doc2rst\process\SourceScout::Methods:

Methods
+++++++


.. _bhenk\doc2rst\process\SourceScout::scanSource:

SourceScout::scanSource
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function scanSource(): void


| :tag6:`return` void


----


.. _bhenk\doc2rst\process\SourceScout::makeDirectories:

SourceScout::makeDirectories
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Makes a directory tree in docs/api folder that mirrors the one encountered in application root**





.. code-block:: php

   public function makeDirectories(): int


| :tag6:`return` int  - number of directories actually created


----


.. _bhenk\doc2rst\process\SourceScout::makePhpDirectories:

SourceScout::makePhpDirectories
-------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Makes a directory tree in docs/api folder that mirrors the ones in application root where php-files were found**





.. code-block:: php

   public function makePhpDirectories(): int


| :tag6:`return` int  - number of directories actually created


----


.. _bhenk\doc2rst\process\SourceScout::makeMdDirectories:

SourceScout::makeMdDirectories
------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Makes a directory tree in docs/api folder that mirrors the ones in application root where md-files were found**





.. code-block:: php

   public function makeMdDirectories(): int


| :tag6:`return` int  - number of directories actually created


----


.. _bhenk\doc2rst\process\SourceScout::makeRstDirectories:

SourceScout::makeRstDirectories
-------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Makes a directory tree in docs/api folder that mirrors the ones in application root where rst-files were found**





.. code-block:: php

   public function makeRstDirectories(): int


| :tag6:`return` int  - number of directories actually created


----


.. _bhenk\doc2rst\process\SourceScout::makeTocFiles:

SourceScout::makeTocFiles
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function makeTocFiles(
         Parameter #0 [ <required> int $flags ]
    ): int


| :tag6:`param` int :param:`$flags`
| :tag6:`return` int


----

:block:`no datestamp` 
