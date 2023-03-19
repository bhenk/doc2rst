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

.. _bhenk\doc2rst\tag\TagInterface:

TagInterface
============

.. table::
   :widths: auto
   :align: left

   ===================== ====================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================== 
   namespace             bhenk\\doc2rst\\tag                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
   predicates            Abstract | Interface                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
   known implementations :ref:`bhenk\doc2rst\tag\AbstractLinkTag` | :ref:`bhenk\doc2rst\tag\AbstractSimpleTag` | :ref:`bhenk\doc2rst\tag\AbstractTag` | :ref:`bhenk\doc2rst\tag\AbstractTypeTag` | :ref:`bhenk\doc2rst\tag\AbstractVersionTag` | :ref:`bhenk\doc2rst\tag\ApiTag` | :ref:`bhenk\doc2rst\tag\AuthorTag` | :ref:`bhenk\doc2rst\tag\CopyrightTag` | :ref:`bhenk\doc2rst\tag\DeprecatedTag` | :ref:`bhenk\doc2rst\tag\GeneratedTag` | :ref:`bhenk\doc2rst\tag\InheritdocTag` | :ref:`bhenk\doc2rst\tag\InternalTag` | :ref:`bhenk\doc2rst\tag\LicenseTag` | :ref:`bhenk\doc2rst\tag\LinkTag` | :ref:`bhenk\doc2rst\tag\PackageTag` | :ref:`bhenk\doc2rst\tag\ParamTag` | :ref:`bhenk\doc2rst\tag\ReturnTag` | :ref:`bhenk\doc2rst\tag\SeeTag` | :ref:`bhenk\doc2rst\tag\SinceTag` | :ref:`bhenk\doc2rst\tag\ThrowsTag` | :ref:`bhenk\doc2rst\tag\TodoTag` | :ref:`bhenk\doc2rst\tag\UsesTag` | :ref:`bhenk\doc2rst\tag\VarTag` | :ref:`bhenk\doc2rst\tag\VersionTag` 
   ===================== ====================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================== 


.. contents::


----


.. _bhenk\doc2rst\tag\TagInterface::Methods:

Methods
+++++++


.. _bhenk\doc2rst\tag\TagInterface::toRst:

TagInterface::toRst
-------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


**Express this Tag in reStructuredText**


.. code-block:: php

   public abstract function toRst(): string


| :tag6:`return` string  - reStructuredText representation of this Tag


----


.. _bhenk\doc2rst\tag\TagInterface::getTagName:

TagInterface::getTagName
------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


**Gets the tag-name of this Tag**


.. code-block:: php

   public abstract function getTagName(): string


| :tag6:`return` string  - tag-name of this Tag


----


.. _bhenk\doc2rst\tag\TagInterface::getDisplayName:

TagInterface::getDisplayName
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


**Get the short version of this tagname, without the at-sign (@)**


.. code-block:: php

   public abstract function getDisplayName(): string


| :tag6:`return` string  - short version of this tagname


----


.. _bhenk\doc2rst\tag\TagInterface::isInline:

TagInterface::isInline
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


**Is this an inline tag**


Is this an inline tag (with curly braces) or does this tag appear at the start of a line.


.. code-block:: php

   public abstract function isInline(): bool


| :tag6:`return` bool  - *true* if this is an inline link, *false* otherwise


----


.. _bhenk\doc2rst\tag\TagInterface::getTagLength:

TagInterface::getTagLength
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


**Get the length (in characters) of this tagname**





.. code-block:: php

   public abstract function getTagLength(): int


| :tag6:`return` int  - length (in characters) of this tagname


----


.. _bhenk\doc2rst\tag\TagInterface::getGroupWidth:

TagInterface::getGroupWidth
---------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


**Get the width (in characters) of the group in which this Tag will be displayed**


.. code-block:: php

   public abstract function getGroupWidth(): int


| :tag6:`return` int  - width (in characters) or -1 if not yet set


----


.. _bhenk\doc2rst\tag\TagInterface::setGroupWidth:

TagInterface::setGroupWidth
---------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


**Set the width (in characters) of the group in which this Tag will be displayed**


.. code-block:: php

   public abstract function setGroupWidth(
         Parameter #0 [ <required> int $max_width ]
    ): void


| :tag6:`param` int :param:`$max_width` - width (in characters)
| :tag6:`return` void


----

:block:`Sun, 19 Mar 2023 19:22:58 +0000` 
