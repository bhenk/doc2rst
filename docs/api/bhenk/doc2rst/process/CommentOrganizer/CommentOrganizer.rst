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

.. _bhenk\doc2rst\process\CommentOrganizer:

CommentOrganizer
================

.. table::
   :widths: auto
   :align: left

   ========== ================================================================== 
   namespace  bhenk\\doc2rst\\process                                            
   predicates Cloneable | Instantiable                                           
   implements `Stringable <https://www.php.net/manual/en/class.stringable.php>`_ 
   ========== ================================================================== 


.. contents::


----


.. _bhenk\doc2rst\process\CommentOrganizer::Constructor:

Constructor
+++++++++++


.. _bhenk\doc2rst\process\CommentOrganizer::__construct:

CommentOrganizer::__construct
-----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


.. code-block:: php

   public function __construct(
         Parameter #0 [ <optional> bool $indented = false ]
    )


| :tag5:`param` bool :param:`$indented`


----


.. _bhenk\doc2rst\process\CommentOrganizer::Methods:

Methods
+++++++


.. _bhenk\doc2rst\process\CommentOrganizer::isIndented:

CommentOrganizer::isIndented
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function isIndented(): bool


| :tag6:`return` bool


----


.. _bhenk\doc2rst\process\CommentOrganizer::setIndented:

CommentOrganizer::setIndented
-----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setIndented(
         Parameter #0 [ <required> bool $indented ]
    ): void


| :tag6:`param` bool :param:`$indented`
| :tag6:`return` void


----


.. _bhenk\doc2rst\process\CommentOrganizer::setOrder:

CommentOrganizer::setOrder
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function setOrder()



----


.. _bhenk\doc2rst\process\CommentOrganizer::render:

CommentOrganizer::render
------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function render(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\process\CommentOrganizer::__toString:

CommentOrganizer::__toString
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== =================================================================================== 
   predicates public                                                                              
   implements `Stringable::__toString <https://www.php.net/manual/en/stringable.__tostring.php>`_ 
   ========== =================================================================================== 





.. code-block:: php

   public function __toString(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\process\CommentOrganizer::getSummary:

CommentOrganizer::getSummary
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getSummary(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\process\CommentOrganizer::setSummary:

CommentOrganizer::setSummary
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setSummary(
         Parameter #0 [ <required> Stringable|string $summary ]
    ): void


| :tag6:`param` `Stringable <https://www.php.net/manual/en/class.stringable.php>`_ | string :param:`$summary`
| :tag6:`return` void


----


.. _bhenk\doc2rst\process\CommentOrganizer::getLines:

CommentOrganizer::getLines
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getLines(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\process\CommentOrganizer::setLines:

CommentOrganizer::setLines
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setLines(
         Parameter #0 [ <required> array $lines ]
    ): void


| :tag6:`param` array :param:`$lines`
| :tag6:`return` void


----


.. _bhenk\doc2rst\process\CommentOrganizer::addLine:

CommentOrganizer::addLine
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function addLine(
         Parameter #0 [ <required> Stringable|string $line ]
    ): void


| :tag6:`param` `Stringable <https://www.php.net/manual/en/class.stringable.php>`_ | string :param:`$line`
| :tag6:`return` void


----


.. _bhenk\doc2rst\process\CommentOrganizer::getSignature:

CommentOrganizer::getSignature
------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getSignature(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\process\CommentOrganizer::setSignature:

CommentOrganizer::setSignature
------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setSignature(
         Parameter #0 [ <required> string $signature ]
    ): void


| :tag6:`param` string :param:`$signature`
| :tag6:`return` void


----


.. _bhenk\doc2rst\process\CommentOrganizer::getTags:

CommentOrganizer::getTags
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getTags(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\process\CommentOrganizer::setTags:

CommentOrganizer::setTags
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setTags(
         Parameter #0 [ <required> array $tags ]
    ): void


| :tag6:`param` array :param:`$tags`
| :tag6:`return` void


----


.. _bhenk\doc2rst\process\CommentOrganizer::addTag:

CommentOrganizer::addTag
------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function addTag(
         Parameter #0 [ <required> bhenk\doc2rst\tag\TagInterface $tag ]
    ): void


| :tag6:`param` :ref:`bhenk\doc2rst\tag\TagInterface` :param:`$tag`
| :tag6:`return` void


----


.. _bhenk\doc2rst\process\CommentOrganizer::getTagsByName:

CommentOrganizer::getTagsByName
-------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getTagsByName(
         Parameter #0 [ <required> string $tagname ]
    ): array


| :tag6:`param` string :param:`$tagname`
| :tag6:`return` array


----


.. _bhenk\doc2rst\process\CommentOrganizer::removeTagsByName:

CommentOrganizer::removeTagsByName
----------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function removeTagsByName(
         Parameter #0 [ <required> string $tagname ]
    ): array


| :tag6:`param` string :param:`$tagname`
| :tag6:`return` array


----

:block:`Fri, 17 Mar 2023 13:51:23 +0000` 
