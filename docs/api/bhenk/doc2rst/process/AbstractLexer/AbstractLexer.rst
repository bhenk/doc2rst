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

.. _bhenk\doc2rst\process\AbstractLexer:

AbstractLexer
=============

.. table::
   :widths: auto
   :align: left

   ================ ======================================================================================================================================================================================================================== 
   namespace        bhenk\\doc2rst\\process                                                                                                                                                                                                  
   predicates       Abstract                                                                                                                                                                                                                 
   implements       `Stringable <https://www.php.net/manual/en/class.stringable.php>`_                                                                                                                                                       
   known subclasses :ref:`bhenk\doc2rst\process\ClassLexer` | :ref:`bhenk\doc2rst\process\CommentLexer` | :ref:`bhenk\doc2rst\process\ConstantLexer` | :ref:`bhenk\doc2rst\process\FunctionLexer` | :ref:`bhenk\doc2rst\process\MethodLexer` 
   ================ ======================================================================================================================================================================================================================== 


.. contents::


----


.. _bhenk\doc2rst\process\AbstractLexer::Methods:

Methods
+++++++


.. _bhenk\doc2rst\process\AbstractLexer::__toString:

AbstractLexer::__toString
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== =================================================================================== 
   predicates public                                                                              
   implements `Stringable::__toString <https://www.php.net/manual/en/stringable.__tostring.php>`_ 
   ========== =================================================================================== 









.. admonition::  see also

    `Stringable <https://www.php.net/manual/en/class.stringable.php>`_


.. code-block:: php

   public function __toString(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\process\AbstractLexer::getSegments:

AbstractLexer::getSegments
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getSegments(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\process\AbstractLexer::setSegments:

AbstractLexer::setSegments
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setSegments(
         Parameter #0 [ <required> array $segments ]
    ): void


| :tag6:`param` array :param:`$segments`
| :tag6:`return` void


----


.. _bhenk\doc2rst\process\AbstractLexer::addSegment:

AbstractLexer::addSegment
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function addSegment(
         Parameter #0 [ <required> Stringable|string $segment ]
    ): void


| :tag6:`param` `Stringable <https://www.php.net/manual/en/class.stringable.php>`_ | string :param:`$segment`
| :tag6:`return` void


----


.. _bhenk\doc2rst\process\AbstractLexer::resolveReflectionType:

AbstractLexer::resolveReflectionType
------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ========= 
   predicates protected 
   ========== ========= 


.. code-block:: php

   protected function resolveReflectionType(
         Parameter #0 [ <required> ReflectionType $reflectionType ]
    ): string


| :tag6:`param` `ReflectionType <https://www.php.net/manual/en/class.reflectiontype.php>`_ :param:`$reflectionType`
| :tag6:`return` string


----


.. _bhenk\doc2rst\process\AbstractLexer::checkParameters:

AbstractLexer::checkParameters
------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ========= 
   predicates protected 
   ========== ========= 


.. code-block:: php

   protected function checkParameters(
         Parameter #0 [ <required> bhenk\doc2rst\process\CommentLexer $lexer ]
         Parameter #1 [ <required> array $params ]
    ): void


| :tag6:`param` :ref:`bhenk\doc2rst\process\CommentLexer` :param:`$lexer`
| :tag6:`param` array :param:`$params`
| :tag6:`return` void


----

:block:`Fri, 31 Mar 2023 13:22:46 +0000` 
