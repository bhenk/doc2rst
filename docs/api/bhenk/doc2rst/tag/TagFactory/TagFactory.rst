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

.. _bhenk\doc2rst\tag\TagFactory:

TagFactory
==========

.. table::
   :widths: auto
   :align: left

   ========== ======================== 
   namespace  bhenk\\doc2rst\\tag      
   predicates Cloneable | Instantiable 
   ========== ======================== 


.. contents::


----


.. _bhenk\doc2rst\tag\TagFactory::Methods:

Methods
+++++++


.. _bhenk\doc2rst\tag\TagFactory::resolveTags:

TagFactory::resolveTags
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


**Resolve PHPDoc representations of tags to their reStructuredText representation**


.. code-block:: php

   public static function resolveTags(
         Parameter #0 [ <required> string $line ]
    ): string


| :tag6:`param` string :param:`$line` - string [with PHPDoc tags]
| :tag6:`return` string  - string with :tag0:`@internal` rendered reStructuredText representation


----


.. _bhenk\doc2rst\tag\TagFactory::explodeOnTags:

TagFactory::explodeOnTags
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


**Split a line on inline tags**



This is a recursive function. Example:



.. code-block::

    before: "Gets the {@link BarClass} out of the {@link Foo::method}"

    after : ["Gets the ", "{@link BarClass}", " out of the ", "{@link Foo::method}"]





.. code-block:: php

   public static function explodeOnTags(
         Parameter #0 [ <required> string $line ]
         Parameter #1 [ <optional> array $parts = [] ]
    ): array


| :tag6:`param` string :param:`$line` - any string
| :tag6:`param` array :param:`$parts` - optional - any array
| :tag6:`return` array  - with :tech:`$line` exploded on inline tags


----


.. _bhenk\doc2rst\tag\TagFactory::resolveInlineTags:

TagFactory::resolveInlineTags
-----------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function resolveInlineTags(
         Parameter #0 [ <required> array $parts ]
    ): array


| :tag6:`param` array :param:`$parts`
| :tag6:`return` array


----


.. _bhenk\doc2rst\tag\TagFactory::getTagImplementation:

TagFactory::getTagImplementation
--------------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function getTagImplementation(
         Parameter #0 [ <required> string $tag ]
    ): TagInterface|string


| :tag6:`param` string :param:`$tag`
| :tag6:`return` :ref:`bhenk\doc2rst\tag\TagInterface` | string


----

:block:`no datestamp` 
