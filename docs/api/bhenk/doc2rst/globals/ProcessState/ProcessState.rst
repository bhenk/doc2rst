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

.. _bhenk\doc2rst\globals\ProcessState:

ProcessState
============

.. table::
   :widths: auto
   :align: left

   ========== ======================== 
   namespace  bhenk\\doc2rst\\globals  
   predicates Cloneable | Instantiable 
   ========== ======================== 


.. contents::


----


.. _bhenk\doc2rst\globals\ProcessState::Methods:

Methods
~~~~~~~


.. _bhenk\doc2rst\globals\ProcessState::getCurrentParser:

ProcessState::getCurrentParser
++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getCurrentParser(): ?PhpParser


| :tag6:`return` ?\ :ref:`bhenk\doc2rst\work\PhpParser`


----


.. _bhenk\doc2rst\globals\ProcessState::setCurrentParser:

ProcessState::setCurrentParser
++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setCurrentParser(
         Parameter #0 [ <required> ?bhenk\doc2rst\work\PhpParser $current_parser ]
    ): void


| :tag6:`param` ?\ :ref:`bhenk\doc2rst\work\PhpParser` :param:`$current_parser`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\ProcessState::getCurrentClass:

ProcessState::getCurrentClass
+++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getCurrentClass(): ?ReflectionClass


| :tag6:`return` ?\ `ReflectionClass <https://www.php.net/manual/en/class.reflectionclass.php>`_


----


.. _bhenk\doc2rst\globals\ProcessState::setCurrentClass:

ProcessState::setCurrentClass
+++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setCurrentClass(
         Parameter #0 [ <required> ?ReflectionClass $current_class ]
    ): void


| :tag6:`param` ?\ `ReflectionClass <https://www.php.net/manual/en/class.reflectionclass.php>`_ :param:`$current_class`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\ProcessState::getCurrentMethod:

ProcessState::getCurrentMethod
++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getCurrentMethod(): ?ReflectionMethod


| :tag6:`return` ?\ `ReflectionMethod <https://www.php.net/manual/en/class.reflectionmethod.php>`_


----


.. _bhenk\doc2rst\globals\ProcessState::setCurrentMethod:

ProcessState::setCurrentMethod
++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setCurrentMethod(
         Parameter #0 [ <required> ?ReflectionMethod $current_method ]
    ): void


| :tag6:`param` ?\ `ReflectionMethod <https://www.php.net/manual/en/class.reflectionmethod.php>`_ :param:`$current_method`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\ProcessState::getCurrentMethodStart:

ProcessState::getCurrentMethodStart
+++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getCurrentMethodStart(): int|bool


| :tag6:`return` int | bool


----


.. _bhenk\doc2rst\globals\ProcessState::getCurrentMethodEnd:

ProcessState::getCurrentMethodEnd
+++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getCurrentMethodEnd(): int|bool


| :tag6:`return` int | bool


----


.. _bhenk\doc2rst\globals\ProcessState::getCurrentConstant:

ProcessState::getCurrentConstant
++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getCurrentConstant(): ?ReflectionClassConstant


| :tag6:`return` ?\ `ReflectionClassConstant <https://www.php.net/manual/en/class.reflectionclassconstant.php>`_


----


.. _bhenk\doc2rst\globals\ProcessState::setCurrentConstant:

ProcessState::setCurrentConstant
++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setCurrentConstant(
         Parameter #0 [ <required> ?ReflectionClassConstant $current_constant ]
    ): void


| :tag6:`param` ?\ `ReflectionClassConstant <https://www.php.net/manual/en/class.reflectionclassconstant.php>`_ :param:`$current_constant`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\ProcessState::getPointer:

ProcessState::getPointer
++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function getPointer(
         Parameter #0 [ <optional> bool $file_prefix = true ]
    ): string


| :tag6:`param` bool :param:`$file_prefix`
| :tag6:`return` string


----

:block:`no datestamp` 
