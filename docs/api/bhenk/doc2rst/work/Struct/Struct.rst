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

.. _bhenk\doc2rst\work\Struct:

Struct
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


.. _bhenk\doc2rst\work\Struct::Constructor:

Constructor
+++++++++++


.. _bhenk\doc2rst\work\Struct::__construct:

Struct::__construct
-------------------

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


.. code-block:: php

   public function __construct(
         Parameter #0 [ <required> int $line ]
         Parameter #1 [ <optional> ?string $name = NULL ]
         Parameter #2 [ <optional> mixed $value = NULL ]
         Parameter #3 [ <optional> int $doc_comment_start = -1 ]
         Parameter #4 [ <optional> ?string $doc_comment = NULL ]
    )


| :tag5:`param` int :param:`$line`
| :tag5:`param` ?\ string :param:`$name`
| :tag5:`param` mixed :param:`$value`
| :tag5:`param` int :param:`$doc_comment_start`
| :tag5:`param` ?\ string :param:`$doc_comment`


----


.. _bhenk\doc2rst\work\Struct::Methods:

Methods
+++++++


.. _bhenk\doc2rst\work\Struct::getLine:

Struct::getLine
---------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getLine(): int


| :tag6:`return` int


----


.. _bhenk\doc2rst\work\Struct::getName:

Struct::getName
---------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getName(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\work\Struct::getValue:

Struct::getValue
----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getValue(): mixed


| :tag6:`return` mixed


----


.. _bhenk\doc2rst\work\Struct::getType:

Struct::getType
---------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getType(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\work\Struct::getDocComment:

Struct::getDocComment
---------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getDocComment(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\doc2rst\work\Struct::getDocCommentStart:

Struct::getDocCommentStart
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getDocCommentStart(): int


| :tag6:`return` int


----


.. _bhenk\doc2rst\work\Struct::getDocCommentEnd:

Struct::getDocCommentEnd
------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getDocCommentEnd(): int


| :tag6:`return` int


----


.. _bhenk\doc2rst\work\Struct::getDocCommentDistance:

Struct::getDocCommentDistance
-----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function getDocCommentDistance(): int


| :tag6:`return` int


----

:block:`Sun, 19 Mar 2023 14:54:43 +0000` 
