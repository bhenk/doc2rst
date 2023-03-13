.. <!--
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

.. end required roles -->

.. _bhenk\doc2rst\process\ProcessManager:

ProcessManager
==============

.. table::
   :widths: auto
   :align: left

   ========== ======================== 
   namespace  bhenk\\doc2rst\\process  
   predicates Cloneable | Instantiable 
   ========== ======================== 


**Runs the transformation of source files to restructured text files**


.. contents::


----


.. _bhenk\doc2rst\process\ProcessManager::Constructor:

Constructor
~~~~~~~~~~~


.. _bhenk\doc2rst\process\ProcessManager::__construct:

ProcessManager::__construct
+++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


**Constructs a new ProcessManager**





.. code-block:: php

   public function __construct(
         Parameter #0 [ <required> string $doc_root ]
    )


| :tag5:`param` string :param:`$doc_root` - The documentation directory; autoconfiguration is computed from this directory.


----


.. _bhenk\doc2rst\process\ProcessManager::Methods:

Methods
~~~~~~~


.. _bhenk\doc2rst\process\ProcessManager::getConstitution:

ProcessManager::getConstitution
+++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getConstitution(): ConstitutionInterface


| :tag6:`return` :ref:`bhenk\doc2rst\process\ConstitutionInterface`


----


.. _bhenk\doc2rst\process\ProcessManager::setConstitution:

ProcessManager::setConstitution
+++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setConstitution(
         Parameter #0 [ <required> bhenk\doc2rst\process\ConstitutionInterface $constitution ]
    ): void


| :tag6:`param` :ref:`bhenk\doc2rst\process\ConstitutionInterface` :param:`$constitution`
| :tag6:`return` void


----


.. _bhenk\doc2rst\process\ProcessManager::quickStart:

ProcessManager::quickStart
++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function quickStart(): void


| :tag6:`return` void


----


.. _bhenk\doc2rst\process\ProcessManager::run:

ProcessManager::run
+++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function run(): void


| :tag6:`return` void


----

:block:`Mon, 13 Mar 2023 21:41:13 +0000` 
