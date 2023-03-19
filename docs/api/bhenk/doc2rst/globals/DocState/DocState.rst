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

.. _bhenk\doc2rst\globals\DocState:

DocState
========

.. table::
   :widths: auto
   :align: left

   ========== ======================== 
   namespace  bhenk\\doc2rst\\globals  
   predicates Cloneable | Instantiable 
   ========== ======================== 


.. contents::


----


.. _bhenk\doc2rst\globals\DocState::Methods:

Methods
+++++++


.. _bhenk\doc2rst\globals\DocState::isPreRun:

DocState::isPreRun
------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function isPreRun(): bool


| :tag6:`return` bool


----


.. _bhenk\doc2rst\globals\DocState::setPreRun:

DocState::setPreRun
-------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setPreRun(
         Parameter #0 [ <required> bool $preRun ]
    ): void


| :tag6:`param` bool :param:`$preRun`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\DocState::addAbsoluteFile:

DocState::addAbsoluteFile
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function addAbsoluteFile(
         Parameter #0 [ <required> string $abs_file ]
    ): void


| :tag6:`param` string :param:`$abs_file`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\DocState::addAbsoluteDir:

DocState::addAbsoluteDir
------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function addAbsoluteDir(
         Parameter #0 [ <required> string $abs_dir ]
    ): void


| :tag6:`param` string :param:`$abs_dir`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\DocState::getHash:

DocState::getHash
-----------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function getHash(
         Parameter #0 [ <required> string $filename ]
    ): string


| :tag6:`param` string :param:`$filename`
| :tag6:`return` string


----


.. _bhenk\doc2rst\globals\DocState::getPreRunFiles:

DocState::getPreRunFiles
------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getPreRunFiles(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\globals\DocState::setPreRunFiles:

DocState::setPreRunFiles
------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setPreRunFiles(
         Parameter #0 [ <required> array $preRunFiles ]
    ): void


| :tag6:`param` array :param:`$preRunFiles`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\DocState::getPreRunDirs:

DocState::getPreRunDirs
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getPreRunDirs(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\globals\DocState::setPreRunDirs:

DocState::setPreRunDirs
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setPreRunDirs(
         Parameter #0 [ <required> array $preRunDirs ]
    ): void


| :tag6:`param` array :param:`$preRunDirs`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\DocState::getPostRunFiles:

DocState::getPostRunFiles
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getPostRunFiles(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\globals\DocState::setPostRunFiles:

DocState::setPostRunFiles
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setPostRunFiles(
         Parameter #0 [ <required> array $postRunFiles ]
    ): void


| :tag6:`param` array :param:`$postRunFiles`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\DocState::getPostRunDirs:

DocState::getPostRunDirs
------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getPostRunDirs(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\globals\DocState::setPostRunDirs:

DocState::setPostRunDirs
------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setPostRunDirs(
         Parameter #0 [ <required> array $postRunDirs ]
    ): void


| :tag6:`param` array :param:`$postRunDirs`
| :tag6:`return` void


----

:block:`Sun, 19 Mar 2023 14:54:43 +0000` 
