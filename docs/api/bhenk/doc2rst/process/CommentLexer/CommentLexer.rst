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

.. _bhenk\doc2rst\process\CommentLexer:

CommentLexer
============

.. table::
   :widths: auto
   :align: left

   ========== ======================================================================================= 
   namespace  bhenk\\doc2rst\\process                                                                 
   predicates Cloneable | Instantiable                                                                
   implements `Stringable <https://www.php.net/manual/en/class.stringable.php>`_                      
   extends    :ref:`bhenk\doc2rst\process\AbstractLexer`                                              
   hierarchy  :ref:`bhenk\doc2rst\process\CommentLexer` -> :ref:`bhenk\doc2rst\process\AbstractLexer` 
   ========== ======================================================================================= 


**Reads and processes DocComments**


According to `PSR-5 Definitions <https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc.md#3-definitions>`_
a "DocComment" is a special type of comment which MUST

* start with the character sequence :tech:`/**` followed by a whitespace character
* end with :tech:`*\ /` and
* have zero or more lines in between.

This CommentLexer reads *summary* lines up to the first period or the first white line is encountered.
The rest of the PHPdoc comment is treated as *description*.

Inline tags are treated as such and rendered at their
original location in the text. Inline tags begin with :tech:`{\ @` and end with a :tech:`}`. Non-inline tags
that are not at the start of a line, will not be rendered. (For instance @link http://whatever.com whatever.)

Tags at the start of a line are filtered out, rendered and appear in a predefined order and location
in the documentation. @todo link to comment and tag order



.. contents::


----


.. _bhenk\doc2rst\process\CommentLexer::Constructor:

Constructor
+++++++++++


.. _bhenk\doc2rst\process\CommentLexer::__construct:

CommentLexer::__construct
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ==================== 
   predicates public | constructor 
   ========== ==================== 


**Constructs a new CommentLexer**





.. code-block:: php

   public function __construct(
         Parameter #0 [ <required> string $docComment ]
         Parameter #1 [ <optional> bool $ignoreInheritdoc = false ]
    )


| :tag5:`param` string :param:`$docComment` - string that starts with :tech:`/**` followed by a whitespace character
| :tag5:`param` bool :param:`$ignoreInheritdoc`


----


.. _bhenk\doc2rst\process\CommentLexer::Methods:

Methods
+++++++


.. _bhenk\doc2rst\process\CommentLexer::getCommentOrganizer:

CommentLexer::getCommentOrganizer
---------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function getCommentOrganizer(): CommentOrganizer


| :tag6:`return` :ref:`bhenk\doc2rst\process\CommentOrganizer`


----


.. _bhenk\doc2rst\process\CommentLexer::lex:

CommentLexer::lex
-----------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   public function lex(): void


| :tag6:`return` void


----


.. _bhenk\doc2rst\process\CommentLexer::markupSummary:

CommentLexer::markupSummary
---------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


.. code-block:: php

   public function markupSummary(
         Parameter #0 [ <required> array $processed ]
    ): array


| :tag6:`param` array :param:`$processed`
| :tag6:`return` array


----


.. _bhenk\doc2rst\process\CommentLexer::preserveMarkup:

CommentLexer::preserveMarkup
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


**Preserve markup in an otherwise** *strong* **line**



Example:



.. code-block::

    before: "Preserves italic *null* and ticks ``true`` markup"

    after:  "**Preserves italic** *null* **and ticks** ``true`` **markup**"





.. code-block:: php

   public static function preserveMarkup(
         Parameter #0 [ <required> string $line ]
    ): string


| :tag6:`param` string :param:`$line` - any string
| :tag6:`return` string  - string with **bold** markup and other markup preserved


----


.. _bhenk\doc2rst\process\CommentLexer::__toString:

CommentLexer::__toString
------------------------

.. table::
   :widths: auto
   :align: left

   ============== =================================================================================== 
   predicates     public                                                                              
   implements     `Stringable::__toString <https://www.php.net/manual/en/stringable.__tostring.php>`_ 
   inherited from :ref:`bhenk\doc2rst\process\AbstractLexer::__toString`                              
   ============== =================================================================================== 








.. admonition::  see also

    `Stringable <https://www.php.net/manual/en/class.stringable.php>`_


.. code-block:: php

   public function __toString(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\process\CommentLexer::getSegments:

CommentLexer::getSegments
-------------------------

.. table::
   :widths: auto
   :align: left

   ============== ======================================================= 
   predicates     public                                                  
   inherited from :ref:`bhenk\doc2rst\process\AbstractLexer::getSegments` 
   ============== ======================================================= 





.. code-block:: php

   public function getSegments(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\process\CommentLexer::setSegments:

CommentLexer::setSegments
-------------------------

.. table::
   :widths: auto
   :align: left

   ============== ======================================================= 
   predicates     public                                                  
   inherited from :ref:`bhenk\doc2rst\process\AbstractLexer::setSegments` 
   ============== ======================================================= 





.. code-block:: php

   public function setSegments(
         Parameter #0 [ <required> array $segments ]
    ): void


| :tag6:`param` array :param:`$segments`
| :tag6:`return` void


----


.. _bhenk\doc2rst\process\CommentLexer::addSegment:

CommentLexer::addSegment
------------------------

.. table::
   :widths: auto
   :align: left

   ============== ====================================================== 
   predicates     public                                                 
   inherited from :ref:`bhenk\doc2rst\process\AbstractLexer::addSegment` 
   ============== ====================================================== 


.. code-block:: php

   public function addSegment(
         Parameter #0 [ <required> Stringable|string $segment ]
    ): void


| :tag6:`param` `Stringable <https://www.php.net/manual/en/class.stringable.php>`_ | string :param:`$segment`
| :tag6:`return` void


----


.. _bhenk\doc2rst\process\CommentLexer::resolveReflectionType:

CommentLexer::resolveReflectionType
-----------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ================================================================= 
   predicates     protected                                                         
   inherited from :ref:`bhenk\doc2rst\process\AbstractLexer::resolveReflectionType` 
   ============== ================================================================= 


.. code-block:: php

   protected function resolveReflectionType(
         Parameter #0 [ <required> ReflectionType $reflectionType ]
    ): string


| :tag6:`param` `ReflectionType <https://www.php.net/manual/en/class.reflectiontype.php>`_ :param:`$reflectionType`
| :tag6:`return` string


----


.. _bhenk\doc2rst\process\CommentLexer::checkParameters:

CommentLexer::checkParameters
-----------------------------

.. table::
   :widths: auto
   :align: left

   ============== =========================================================== 
   predicates     protected                                                   
   inherited from :ref:`bhenk\doc2rst\process\AbstractLexer::checkParameters` 
   ============== =========================================================== 


.. code-block:: php

   protected function checkParameters(
         Parameter #0 [ <required> bhenk\doc2rst\process\CommentLexer $lexer ]
         Parameter #1 [ <required> array $params ]
    ): void


| :tag6:`param` :ref:`bhenk\doc2rst\process\CommentLexer` :param:`$lexer`
| :tag6:`param` array :param:`$params`
| :tag6:`return` void


----

:block:`Sun, 19 Mar 2023 14:54:43 +0000` 
