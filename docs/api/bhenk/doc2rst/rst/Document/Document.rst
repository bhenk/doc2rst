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

.. _bhenk\doc2rst\rst\Document:

Document
========

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


.. _bhenk\doc2rst\rst\Document::Constructor:

Constructor
~~~~~~~~~~~


.. _bhenk\doc2rst\rst\Document::__construct:

Document::__construct
+++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


.. code-block:: php

   public function __construct(
         Parameter #0 [ <required> string $filename ]
    )


| :tag5:`param` string :param:`$filename`


----


.. _bhenk\doc2rst\rst\Document::Methods:

Methods
~~~~~~~


.. _bhenk\doc2rst\rst\Document::getFilename:

Document::getFilename
+++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getFilename(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\rst\Document::setFilename:

Document::setFilename
+++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setFilename(
         Parameter #0 [ <required> string $filename ]
    ): void


| :tag6:`param` string :param:`$filename`
| :tag6:`return` void


----


.. _bhenk\doc2rst\rst\Document::setDirectory:

Document::setDirectory
++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function setDirectory(
         Parameter #0 [ <required> string $dir ]
    ): void


| :tag6:`param` string :param:`$dir`
| :tag6:`return` void


----


.. _bhenk\doc2rst\rst\Document::putContents:

Document::putContents
+++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function putContents(): void


| :tag6:`return` void


----


.. _bhenk\doc2rst\rst\Document::__toString:

Document::__toString
++++++++++++++++++++

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


.. _bhenk\doc2rst\rst\Document::getEntries:

Document::getEntries
++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getEntries(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\rst\Document::setEntries:

Document::setEntries
++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setEntries(
         Parameter #0 [ <required> array $entries ]
    ): void


| :tag6:`param` array :param:`$entries`
| :tag6:`return` void


----


.. _bhenk\doc2rst\rst\Document::addEntry:

Document::addEntry
++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function addEntry(
         Parameter #0 [ <required> Stringable|string $entry ]
    ): Stringable|string


| :tag6:`param` `Stringable <https://www.php.net/manual/en/class.stringable.php>`_ | string :param:`$entry`
| :tag6:`return` `Stringable <https://www.php.net/manual/en/class.stringable.php>`_ | string


----

:block:`Mon, 13 Mar 2023 21:41:13 +0000` 
