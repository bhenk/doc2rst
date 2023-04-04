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

.. _bhenk\doc2rst\rst\Title:

Title
=====

.. table::
   :widths: auto
   :align: left

   ========== ================================================================== 
   namespace  bhenk\\doc2rst\\rst                                                
   predicates Cloneable | Instantiable                                           
   implements `Stringable <https://www.php.net/manual/en/class.stringable.php>`_ 
   ========== ================================================================== 


.. contents::


----


.. _bhenk\doc2rst\rst\Title::Constructor:

Constructor
+++++++++++


.. _bhenk\doc2rst\rst\Title::__construct:

Title::__construct
------------------

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


.. code-block:: php

   public function __construct(
         Parameter #0 [ <required> string $title ]
         Parameter #1 [ <optional> int $level = 0 ]
    )


| :tag5:`param` string :param:`$title`
| :tag5:`param` int :param:`$level`


----


.. _bhenk\doc2rst\rst\Title::Methods:

Methods
+++++++


.. _bhenk\doc2rst\rst\Title::getTitle:

Title::getTitle
---------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getTitle(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\rst\Title::setTitle:

Title::setTitle
---------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 




| :tag12:`noinspection` PhpUnused


.. code-block:: php

   public function setTitle(
         Parameter #0 [ <required> string $title ]
    ): void


| :tag6:`param` string :param:`$title`
| :tag6:`return` void


----


.. _bhenk\doc2rst\rst\Title::getLevel:

Title::getLevel
---------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 




| :tag12:`noinspection` PhpUnused


.. code-block:: php

   public function getLevel(): int


| :tag6:`return` int


----


.. _bhenk\doc2rst\rst\Title::setLevel:

Title::setLevel
---------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setLevel(
         Parameter #0 [ <required> int $level ]
    ): void


| :tag6:`param` int :param:`$level`
| :tag6:`return` void


----


.. _bhenk\doc2rst\rst\Title::__toString:

Title::__toString
-----------------

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

:block:`no datestamp` 
