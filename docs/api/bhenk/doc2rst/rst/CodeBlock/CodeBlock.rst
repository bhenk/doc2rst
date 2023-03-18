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

.. _bhenk\doc2rst\rst\CodeBlock:

CodeBlock
=========

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


.. _bhenk\doc2rst\rst\CodeBlock::Constructor:

Constructor
+++++++++++


.. _bhenk\doc2rst\rst\CodeBlock::__construct:

CodeBlock::__construct
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


.. code-block:: php

   public function __construct(
         Parameter #0 [ <optional> string $taste = 'php' ]
    )


| :tag5:`param` string :param:`$taste`


----


.. _bhenk\doc2rst\rst\CodeBlock::Methods:

Methods
+++++++


.. _bhenk\doc2rst\rst\CodeBlock::__toString:

CodeBlock::__toString
---------------------

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


.. _bhenk\doc2rst\rst\CodeBlock::getLines:

CodeBlock::getLines
-------------------

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


.. _bhenk\doc2rst\rst\CodeBlock::setLines:

CodeBlock::setLines
-------------------

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


.. _bhenk\doc2rst\rst\CodeBlock::addLine:

CodeBlock::addLine
------------------

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


.. _bhenk\doc2rst\rst\CodeBlock::addPart:

CodeBlock::addPart
------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function addPart(
         Parameter #0 [ <required> Stringable|string $part ]
    ): void


| :tag6:`param` `Stringable <https://www.php.net/manual/en/class.stringable.php>`_ | string :param:`$part`
| :tag6:`return` void


----


.. _bhenk\doc2rst\rst\CodeBlock::getTaste:

CodeBlock::getTaste
-------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getTaste(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\rst\CodeBlock::setTaste:

CodeBlock::setTaste
-------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setTaste(
         Parameter #0 [ <required> string $taste ]
    ): void


| :tag6:`param` string :param:`$taste`
| :tag6:`return` void


----

:block:`Sat, 18 Mar 2023 19:15:02 +0000` 
