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

.. _bhenk\doc2rst\work\Linker:

Linker
======

.. table::
   :widths: auto
   :align: left

   ========== ======================== 
   namespace  bhenk\\doc2rst\\work     
   predicates Cloneable | Instantiable 
   ========== ======================== 


.. contents::


----


.. _bhenk\doc2rst\work\Linker::Methods:

Methods
+++++++


.. _bhenk\doc2rst\work\Linker::getLink:

Linker::getLink
---------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function getLink(
         Parameter #0 [ <required> ?string $search ]
         Parameter #1 [ <optional> ?string $description = NULL ]
    ): string


| :tag6:`param` ?\ string :param:`$search`
| :tag6:`param` ?\ string :param:`$description`
| :tag6:`return` string


----


.. _bhenk\doc2rst\work\Linker::tryCreateLink:

Linker::tryCreateLink
---------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function tryCreateLink(
         Parameter #0 [ <required> string $uri_type ]
         Parameter #1 [ <optional> ?string $description = NULL ]
    ): string


| :tag6:`param` string :param:`$uri_type`
| :tag6:`param` ?\ string :param:`$description`
| :tag6:`return` string


----


.. _bhenk\doc2rst\work\Linker::createLink:

Linker::createLink
------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function createLink(
         Parameter #0 [ <required> string $uri ]
         Parameter #1 [ <required> ?string $desc ]
    ): string|bool


| :tag6:`param` string :param:`$uri`
| :tag6:`param` ?\ string :param:`$desc`
| :tag6:`return` string | bool


----


.. _bhenk\doc2rst\work\Linker::findInParameters:

Linker::findInParameters
------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function findInParameters(
         Parameter #0 [ <required> string $type ]
    ): string|bool


| :tag6:`param` string :param:`$type`
| :tag6:`return` string | bool


----


.. _bhenk\doc2rst\work\Linker::createTypeLink:

Linker::createTypeLink
----------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function createTypeLink(
         Parameter #0 [ <required> string $type ]
         Parameter #1 [ <optional> ?string $description = NULL ]
    ): string


| :tag6:`param` string :param:`$type`
| :tag6:`param` ?\ string :param:`$description`
| :tag6:`return` string


----


.. _bhenk\doc2rst\work\Linker::findFQCN:

Linker::findFQCN
----------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function findFQCN(
         Parameter #0 [ <required> string $type ]
    ): string


| :tag6:`param` string :param:`$type`
| :tag6:`return` string


----

:block:`Fri, 17 Mar 2023 21:34:56 +0000` 
