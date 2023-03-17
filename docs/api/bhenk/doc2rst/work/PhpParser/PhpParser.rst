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

.. _bhenk\doc2rst\work\PhpParser:

PhpParser
=========

.. table::
   :widths: auto
   :align: left

   ========== ======================== 
   namespace  bhenk\\doc2rst\\work     
   predicates Cloneable | Instantiable 
   ========== ======================== 


.. contents::


----


.. _bhenk\doc2rst\work\PhpParser::Constructor:

Constructor
+++++++++++


.. _bhenk\doc2rst\work\PhpParser::__construct:

PhpParser::__construct
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


.. code-block:: php

   public function __construct()



----


.. _bhenk\doc2rst\work\PhpParser::Methods:

Methods
+++++++


.. _bhenk\doc2rst\work\PhpParser::parseFile:

PhpParser::parseFile
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function parseFile(
         Parameter #0 [ <required> string $path ]
    ): void


| :tag6:`param` string :param:`$path`
| :tag6:`return` void


----


.. _bhenk\doc2rst\work\PhpParser::parseString:

PhpParser::parseString
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function parseString(
         Parameter #0 [ <required> string $contents ]
    ): void


| :tag6:`param` string :param:`$contents`
| :tag6:`return` void


----


.. _bhenk\doc2rst\work\PhpParser::parseTokens:

PhpParser::parseTokens
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function parseTokens(
         Parameter #0 [ <required> array $tokens ]
    ): void


| :tag6:`param` array :param:`$tokens`
| :tag6:`return` void


----


.. _bhenk\doc2rst\work\PhpParser::getFilename:

PhpParser::getFilename
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getFilename(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\doc2rst\work\PhpParser::getShortName:

PhpParser::getShortName
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getShortName(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\doc2rst\work\PhpParser::isInitialized:

PhpParser::isInitialized
------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function isInitialized(): bool


| :tag6:`return` bool


----


.. _bhenk\doc2rst\work\PhpParser::hasInlineHtml:

PhpParser::hasInlineHtml
------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function hasInlineHtml(): bool


| :tag6:`return` bool


----


.. _bhenk\doc2rst\work\PhpParser::isPhp:

PhpParser::isPhp
----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function isPhp(): bool


| :tag6:`return` bool


----


.. _bhenk\doc2rst\work\PhpParser::isPlainPhpFile:

PhpParser::isPlainPhpFile
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function isPlainPhpFile(): bool


| :tag6:`return` bool


----


.. _bhenk\doc2rst\work\PhpParser::isClassFile:

PhpParser::isClassFile
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function isClassFile(): bool


| :tag6:`return` bool


----


.. _bhenk\doc2rst\work\PhpParser::isInterfaceFile:

PhpParser::isInterfaceFile
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function isInterfaceFile(): bool


| :tag6:`return` bool


----


.. _bhenk\doc2rst\work\PhpParser::isTraitFile:

PhpParser::isTraitFile
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function isTraitFile(): bool


| :tag6:`return` bool


----


.. _bhenk\doc2rst\work\PhpParser::isEnumFile:

PhpParser::isEnumFile
---------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function isEnumFile(): bool


| :tag6:`return` bool


----


.. _bhenk\doc2rst\work\PhpParser::getFQName:

PhpParser::getFQName
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getFQName(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\doc2rst\work\PhpParser::getNamespace:

PhpParser::getNamespace
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getNamespace(): ?Struct


| :tag6:`return` ?\ :ref:`bhenk\doc2rst\work\Struct`


----


.. _bhenk\doc2rst\work\PhpParser::getUses:

PhpParser::getUses
------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getUses(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\work\PhpParser::getClass:

PhpParser::getClass
-------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getClass(): ?Struct


| :tag6:`return` ?\ :ref:`bhenk\doc2rst\work\Struct`


----


.. _bhenk\doc2rst\work\PhpParser::getInterface:

PhpParser::getInterface
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getInterface(): ?Struct


| :tag6:`return` ?\ :ref:`bhenk\doc2rst\work\Struct`


----


.. _bhenk\doc2rst\work\PhpParser::getTrait:

PhpParser::getTrait
-------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getTrait(): ?Struct


| :tag6:`return` ?\ :ref:`bhenk\doc2rst\work\Struct`


----


.. _bhenk\doc2rst\work\PhpParser::getEnum:

PhpParser::getEnum
------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getEnum(): ?Struct


| :tag6:`return` ?\ :ref:`bhenk\doc2rst\work\Struct`


----


.. _bhenk\doc2rst\work\PhpParser::getConstants:

PhpParser::getConstants
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getConstants(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\work\PhpParser::getVariables:

PhpParser::getVariables
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getVariables(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\work\PhpParser::getFunctions:

PhpParser::getFunctions
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getFunctions(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\work\PhpParser::getReturn:

PhpParser::getReturn
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getReturn(): ?Struct


| :tag6:`return` ?\ :ref:`bhenk\doc2rst\work\Struct`


----

:block:`Fri, 17 Mar 2023 13:21:36 +0000` 
