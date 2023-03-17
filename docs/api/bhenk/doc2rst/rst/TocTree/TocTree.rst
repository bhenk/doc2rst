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

.. _bhenk\doc2rst\rst\TocTree:

TocTree
=======

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


.. _bhenk\doc2rst\rst\TocTree::Constructor:

Constructor
+++++++++++


.. _bhenk\doc2rst\rst\TocTree::__construct:

TocTree::__construct
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


.. code-block:: php

   public function __construct(
         Parameter #0 [ <optional> array $entries = [] ]
    )


| :tag5:`param` array :param:`$entries`


----


.. _bhenk\doc2rst\rst\TocTree::Methods:

Methods
+++++++


.. _bhenk\doc2rst\rst\TocTree::isEmpty:

TocTree::isEmpty
----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function isEmpty(): bool


| :tag6:`return` bool


----


.. _bhenk\doc2rst\rst\TocTree::__toString:

TocTree::__toString
-------------------

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


.. _bhenk\doc2rst\rst\TocTree::addEntry:

TocTree::addEntry
-----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function addEntry(
         Parameter #0 [ <required> string $link ]
         Parameter #1 [ <optional> ?string $title = NULL ]
    ): void


| :tag6:`param` string :param:`$link`
| :tag6:`param` ?\ string :param:`$title`
| :tag6:`return` void


----


.. _bhenk\doc2rst\rst\TocTree::getEntries:

TocTree::getEntries
-------------------

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


.. _bhenk\doc2rst\rst\TocTree::setEntries:

TocTree::setEntries
-------------------

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


.. _bhenk\doc2rst\rst\TocTree::getMaxDepth:

TocTree::getMaxDepth
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getMaxDepth(): int


| :tag6:`return` int


----


.. _bhenk\doc2rst\rst\TocTree::setMaxDepth:

TocTree::setMaxDepth
--------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setMaxDepth(
         Parameter #0 [ <required> int $max_depth ]
    ): void


| :tag6:`param` int :param:`$max_depth`
| :tag6:`return` void


----


.. _bhenk\doc2rst\rst\TocTree::getCaption:

TocTree::getCaption
-------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getCaption(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\doc2rst\rst\TocTree::setCaption:

TocTree::setCaption
-------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setCaption(
         Parameter #0 [ <required> ?string $caption ]
    ): void


| :tag6:`param` ?\ string :param:`$caption`
| :tag6:`return` void


----


.. _bhenk\doc2rst\rst\TocTree::getName:

TocTree::getName
----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getName(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\doc2rst\rst\TocTree::setName:

TocTree::setName
----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setName(
         Parameter #0 [ <required> ?string $name ]
    ): void


| :tag6:`param` ?\ string :param:`$name`
| :tag6:`return` void


----


.. _bhenk\doc2rst\rst\TocTree::isTitlesOnly:

TocTree::isTitlesOnly
---------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function isTitlesOnly(): bool


| :tag6:`return` bool


----


.. _bhenk\doc2rst\rst\TocTree::setTitlesOnly:

TocTree::setTitlesOnly
----------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function setTitlesOnly(
         Parameter #0 [ <required> bool $titles_only ]
    ): void


| :tag6:`param` bool :param:`$titles_only`
| :tag6:`return` void


----

:block:`Fri, 17 Mar 2023 13:51:23 +0000` 
