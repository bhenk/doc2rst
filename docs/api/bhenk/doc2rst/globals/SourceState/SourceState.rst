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

.. _bhenk\doc2rst\globals\SourceState:

SourceState
===========

.. table::
   :widths: auto
   :align: left

   ========== ======================== 
   namespace  bhenk\\doc2rst\\globals  
   predicates Cloneable | Instantiable 
   ========== ======================== 


.. contents::


----


.. _bhenk\doc2rst\globals\SourceState::Methods:

Methods
+++++++


.. _bhenk\doc2rst\globals\SourceState::countFiles:

SourceState::countFiles
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function countFiles(): int


| :tag6:`return` int


----


.. _bhenk\doc2rst\globals\SourceState::countDirectories:

SourceState::countDirectories
-----------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function countDirectories(): int


| :tag6:`return` int


----


.. _bhenk\doc2rst\globals\SourceState::addDirectory:

SourceState::addDirectory
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function addDirectory(
         Parameter #0 [ <required> string $directory ]
    ): void


| :tag6:`param` string :param:`$directory`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\SourceState::addPhpFile:

SourceState::addPhpFile
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function addPhpFile(
         Parameter #0 [ <required> string $php_file ]
    ): void


| :tag6:`param` string :param:`$php_file`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\SourceState::addJsFile:

SourceState::addJsFile
----------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function addJsFile(
         Parameter #0 [ <required> string $js_file ]
    ): void


| :tag6:`param` string :param:`$js_file`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\SourceState::addSqlFile:

SourceState::addSqlFile
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function addSqlFile(
         Parameter #0 [ <required> string $sql_file ]
    ): void


| :tag6:`param` string :param:`$sql_file`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\SourceState::addMdFile:

SourceState::addMdFile
----------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function addMdFile(
         Parameter #0 [ <required> string $md_file ]
    ): void


| :tag6:`param` string :param:`$md_file`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\SourceState::addRstFile:

SourceState::addRstFile
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function addRstFile(
         Parameter #0 [ <required> string $rst_file ]
    ): void


| :tag6:`param` string :param:`$rst_file`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\SourceState::addOtherFile:

SourceState::addOtherFile
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function addOtherFile(
         Parameter #0 [ <required> string $other_file ]
    ): void


| :tag6:`param` string :param:`$other_file`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\SourceState::getDirectories:

SourceState::getDirectories
---------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getDirectories(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\globals\SourceState::setDirectories:

SourceState::setDirectories
---------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setDirectories(
         Parameter #0 [ <required> array $directories ]
    ): void


| :tag6:`param` array :param:`$directories`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\SourceState::getPhpFiles:

SourceState::getPhpFiles
------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getPhpFiles(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\globals\SourceState::setPhpFiles:

SourceState::setPhpFiles
------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setPhpFiles(
         Parameter #0 [ <required> array $php_files ]
    ): void


| :tag6:`param` array :param:`$php_files`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\SourceState::getJsFiles:

SourceState::getJsFiles
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getJsFiles(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\globals\SourceState::setJsFiles:

SourceState::setJsFiles
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setJsFiles(
         Parameter #0 [ <required> array $js_files ]
    ): void


| :tag6:`param` array :param:`$js_files`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\SourceState::getSqlFiles:

SourceState::getSqlFiles
------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getSqlFiles(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\globals\SourceState::setSqlFiles:

SourceState::setSqlFiles
------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setSqlFiles(
         Parameter #0 [ <required> array $sql_files ]
    ): void


| :tag6:`param` array :param:`$sql_files`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\SourceState::getMdFiles:

SourceState::getMdFiles
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getMdFiles(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\globals\SourceState::setMdFiles:

SourceState::setMdFiles
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setMdFiles(
         Parameter #0 [ <required> array $md_files ]
    ): void


| :tag6:`param` array :param:`$md_files`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\SourceState::getRstFiles:

SourceState::getRstFiles
------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getRstFiles(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\globals\SourceState::setRstFiles:

SourceState::setRstFiles
------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setRstFiles(
         Parameter #0 [ <required> array $rst_files ]
    ): void


| :tag6:`param` array :param:`$rst_files`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\SourceState::getOtherFiles:

SourceState::getOtherFiles
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getOtherFiles(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\globals\SourceState::setOtherFiles:

SourceState::setOtherFiles
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setOtherFiles(
         Parameter #0 [ <required> array $other_files ]
    ): void


| :tag6:`param` array :param:`$other_files`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\SourceState::getFileOrder:

SourceState::getFileOrder
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getFileOrder(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\globals\SourceState::setFileOrder:

SourceState::setFileOrder
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setFileOrder(
         Parameter #0 [ <required> array $file_order ]
    ): void


| :tag6:`param` array :param:`$file_order`
| :tag6:`return` void


----

:block:`Sun, 19 Mar 2023 14:34:48 +0000` 
