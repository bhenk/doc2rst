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

.. _bhenk\doc2rst\format\AbstractFormatter:

AbstractFormatter
=================

.. table::
   :widths: auto
   :align: left

   ================ ====================================================================================================== 
   namespace        bhenk\\doc2rst\\format                                                                                 
   predicates       Abstract                                                                                               
   implements       `Stringable <https://www.php.net/manual/en/class.stringable.php>`_                                     
   known subclasses :ref:`bhenk\doc2rst\format\CodeBlockFormatter` | :ref:`bhenk\doc2rst\format\RestructuredTextFormatter` 
   ================ ====================================================================================================== 


**Formatters transform specific PHPDoc-blocks to reStructuredText**


.. contents::


----


.. _bhenk\doc2rst\format\AbstractFormatter::Methods:

Methods
+++++++


.. _bhenk\doc2rst\format\AbstractFormatter::handleLine:

AbstractFormatter::handleLine
-----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================= 
   predicates public | abstract 
   ========== ================= 


**Handle a line of PHPDoc**


As long as the formatter wants more lines it should return *true*. When it has enough it should return *false*.



.. code-block:: php

   public abstract function handleLine(
         Parameter #0 [ <required> string $line ]
    ): bool


| :tag6:`param` string :param:`$line` - line to format
| :tag6:`return` bool  - *true* if more lines are welcome, *false* otherwise


----


.. _bhenk\doc2rst\format\AbstractFormatter::addLine:

AbstractFormatter::addLine
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ========= 
   predicates protected 
   ========== ========= 


**Add a line to the resulting block**


.. code-block:: php

   protected function addLine(
         Parameter #0 [ <required> Stringable|string $line ]
    ): void


| :tag6:`param` `Stringable <https://www.php.net/manual/en/class.stringable.php>`_ | string :param:`$line` - the line to add
| :tag6:`return` void


----


.. _bhenk\doc2rst\format\AbstractFormatter::__toString:

AbstractFormatter::__toString
-----------------------------

.. table::
   :widths: auto
   :align: left

   ========== =================================================================================== 
   predicates public                                                                              
   implements `Stringable::__toString <https://www.php.net/manual/en/stringable.__tostring.php>`_ 
   ========== =================================================================================== 


**Returns a reStructuredText representation of the contents of the block**


.. code-block:: php

   public function __toString(): string


| :tag6:`return` string  - reStructuredText representation of the contents


----


.. _bhenk\doc2rst\format\AbstractFormatter::getLineCount:

AbstractFormatter::getLineCount
-------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ========= 
   predicates protected 
   ========== ========= 





.. code-block:: php

   protected function getLineCount(): int


| :tag6:`return` int


----


.. _bhenk\doc2rst\format\AbstractFormatter::increaseLineCount:

AbstractFormatter::increaseLineCount
------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ========= 
   predicates protected 
   ========== ========= 


.. code-block:: php

   protected function increaseLineCount(): int


| :tag6:`return` int


----

:block:`Sun, 19 Mar 2023 19:22:58 +0000` 
