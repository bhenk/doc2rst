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

.. _bhenk\doc2rst\globals\D2R:

D2R
===

.. table::
   :widths: auto
   :align: left

   ========== ======================== 
   namespace  bhenk\\doc2rst\\globals  
   predicates Cloneable | Instantiable 
   ========== ======================== 


**Loads internal and external configuration files**





.. admonition::  see also

    :doc:`package d2r</api/bhenk/doc2rst/d2r/d2r>`


.. contents::


----


.. _bhenk\doc2rst\globals\D2R::Constants:

Constants
+++++++++


.. _bhenk\doc2rst\globals\D2R::CONFIGURATION_FILENAME:

D2R::CONFIGURATION_FILENAME
---------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   string(12) "d2r-conf.php" 




----


.. _bhenk\doc2rst\globals\D2R::STYLES_FILENAME:

D2R::STYLES_FILENAME
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   string(14) "d2r-styles.txt" 




----


.. _bhenk\doc2rst\globals\D2R::COMMENT_ORDER_FILENAME:

D2R::COMMENT_ORDER_FILENAME
---------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   string(13) "d2r-order.php" 




----


.. _bhenk\doc2rst\globals\D2R::Methods:

Methods
+++++++


.. _bhenk\doc2rst\globals\D2R::getStyles:

D2R::getStyles
--------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function getStyles(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\globals\D2R::getCommentOrder:

D2R::getCommentOrder
--------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function getCommentOrder(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\globals\D2R::getTagStyle:

D2R::getTagStyle
----------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function getTagStyle(
         Parameter #0 [ <required> string $tag_name ]
    ): string


| :tag6:`param` string :param:`$tag_name`
| :tag6:`return` string


----


.. _bhenk\doc2rst\globals\D2R::getCommentOrderContents:

D2R::getCommentOrderContents
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function getCommentOrderContents(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\globals\D2R::getInternalOrderFilename:

D2R::getInternalOrderFilename
-----------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function getInternalOrderFilename(): string


| :tag6:`return` string


----

:block:`Sun, 19 Mar 2023 14:54:43 +0000` 
