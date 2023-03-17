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

.. _bhenk\doc2rst\tag\AbstractSimpleTag:

AbstractSimpleTag
=================

.. table::
   :widths: auto
   :align: left

   ================ ============================================================================================================================================================================================================================================== 
   namespace        bhenk\\doc2rst\\tag                                                                                                                                                                                                                            
   predicates       Abstract                                                                                                                                                                                                                                       
   implements       `Stringable <https://www.php.net/manual/en/class.stringable.php>`_ | :ref:`bhenk\doc2rst\tag\TagInterface`                                                                                                                                     
   extends          :ref:`bhenk\doc2rst\tag\AbstractTag`                                                                                                                                                                                                           
   hierarchy        :ref:`bhenk\doc2rst\tag\AbstractSimpleTag` -> :ref:`bhenk\doc2rst\tag\AbstractTag`                                                                                                                                                             
   known subclasses :ref:`bhenk\doc2rst\tag\AbstractVersionTag` | :ref:`bhenk\doc2rst\tag\CopyrightTag` | :ref:`bhenk\doc2rst\tag\GeneratedTag` | :ref:`bhenk\doc2rst\tag\InheritdocTag` | :ref:`bhenk\doc2rst\tag\InternalTag` | :ref:`bhenk\doc2rst\tag\TodoTag` 
   ================ ============================================================================================================================================================================================================================================== 


**Abstract tag that handles <description> syntax**





.. admonition:: syntax

   .. code-block::

      @tag_name <description>




.. contents::


----


.. _bhenk\doc2rst\tag\AbstractSimpleTag::Constants:

Constants
+++++++++


.. _bhenk\doc2rst\tag\AbstractSimpleTag::TAG:

AbstractSimpleTag::TAG
----------------------

.. table::
   :widths: auto
   :align: left

   ============== ========================================= 
   predicates     public                                    
   Inherited from :ref:`bhenk\doc2rst\tag\AbstractTag::TAG` 
   ============== ========================================= 






| :tag3:`var` string :param:`TAG` - the name of this tag



.. code-block:: php

   string(12) "@name_of_tag" 




----


.. _bhenk\doc2rst\tag\AbstractSimpleTag::Constructor:

Constructor
+++++++++++


.. _bhenk\doc2rst\tag\AbstractSimpleTag::__construct:

AbstractSimpleTag::__construct
------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ================================================= 
   predicates     public | constructor                              
   inherited from :ref:`bhenk\doc2rst\tag\AbstractTag::__construct` 
   ============== ================================================= 


**Construct a new Tag**



The :tagsign:`param` :tech:`$tag_string` should include the at-symbol ``@``, tag name and possibly curly braces.
The string should follow the syntax of the specific Tag being constructed.



.. code-block:: php

   public function __construct(
         Parameter #0 [ <optional> ?string $tag_string = '' ]
    )


| :tag5:`param` ?\ string :param:`$tag_string` - string following syntax of **this** Tag class


----


.. _bhenk\doc2rst\tag\AbstractSimpleTag::Methods:

Methods
+++++++


.. _bhenk\doc2rst\tag\AbstractSimpleTag::render:

AbstractSimpleTag::render
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ============================================ 
   predicates public                                       
   implements :ref:`bhenk\doc2rst\tag\AbstractTag::render` 
   ========== ============================================ 


**Renders the description of simple tags**


.. admonition:: @inheritdoc

    

   **Render the $tag_string**
   
   
   Upon this command subclasses should parse the :tech:`$tag_string`.
   
   
   | :tag6:`return` void
   
   ``@inheritdoc`` from method :ref:`bhenk\doc2rst\tag\AbstractTag::render`


| :tag4:`uses` :ref:`bhenk\doc2rst\tag\TagFactory::resolveTags`


.. code-block:: php

   public function render(): void


| :tag6:`return` void


----


.. _bhenk\doc2rst\tag\AbstractSimpleTag::__toString:

AbstractSimpleTag::__toString
-----------------------------

.. table::
   :widths: auto
   :align: left

   ========== =================================================================================== 
   predicates public                                                                              
   implements `Stringable::__toString <https://www.php.net/manual/en/stringable.__tostring.php>`_ 
   ========== =================================================================================== 


**Returns a reStructuredText representation of the contents of this Tag**


.. code-block:: php

   public function __toString(): string


| :tag6:`return` string  - reStructuredText representation of contents


----


.. _bhenk\doc2rst\tag\AbstractSimpleTag::getDescription:

AbstractSimpleTag::getDescription
---------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Get the <description>**


.. code-block:: php

   public function getDescription(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\doc2rst\tag\AbstractSimpleTag::setDescription:

AbstractSimpleTag::setDescription
---------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 


**Set the <description>**


.. code-block:: php

   public function setDescription(
         Parameter #0 [ <required> ?string $description ]
    ): void


| :tag6:`param` ?\ string :param:`$description`
| :tag6:`return` void


----


.. _bhenk\doc2rst\tag\AbstractSimpleTag::getTagString:

AbstractSimpleTag::getTagString
-------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ================================================== 
   predicates     public                                             
   inherited from :ref:`bhenk\doc2rst\tag\AbstractTag::getTagString` 
   ============== ================================================== 


**Get the $tag_string**


.. code-block:: php

   public function getTagString(): string


| :tag6:`return` string  - string with which **this** Tag was constructed


----


.. _bhenk\doc2rst\tag\AbstractSimpleTag::getLine:

AbstractSimpleTag::getLine
--------------------------

.. table::
   :widths: auto
   :align: left

   ============== ============================================= 
   predicates     public                                        
   inherited from :ref:`bhenk\doc2rst\tag\AbstractTag::getLine` 
   ============== ============================================= 


**Get the content of the $tag_string without the tag name and curly braces**


.. code-block:: php

   public function getLine(): string


| :tag6:`return` string  - content of the $tag_string


----


.. _bhenk\doc2rst\tag\AbstractSimpleTag::getTagName:

AbstractSimpleTag::getTagName
-----------------------------

.. table::
   :widths: auto
   :align: left

   ============== ================================================= 
   predicates     public | abstract                                 
   implements     :ref:`bhenk\doc2rst\tag\TagInterface::getTagName` 
   inherited from :ref:`bhenk\doc2rst\tag\AbstractTag::getTagName`  
   ============== ================================================= 





.. admonition:: @inheritdoc

    

   **Gets the tag-name of this Tag**
   
   | :tag6:`return` string  - tag-name of this Tag
   
   ``@inheritdoc`` from method :ref:`bhenk\doc2rst\tag\TagInterface::getTagName`



.. code-block:: php

   public abstract function getTagName(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\tag\AbstractSimpleTag::getDisplayName:

AbstractSimpleTag::getDisplayName
---------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ===================================================== 
   predicates     public                                                
   implements     :ref:`bhenk\doc2rst\tag\TagInterface::getDisplayName` 
   inherited from :ref:`bhenk\doc2rst\tag\AbstractTag::getDisplayName`  
   ============== ===================================================== 





.. admonition:: @inheritdoc

    

   **Get the short version of this tagname, without the at-sign (@)**
   
   | :tag6:`return` string  - short version of this tagname
   
   ``@inheritdoc`` from method :ref:`bhenk\doc2rst\tag\TagInterface::getDisplayName`



.. code-block:: php

   public function getDisplayName(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\tag\AbstractSimpleTag::isInline:

AbstractSimpleTag::isInline
---------------------------

.. table::
   :widths: auto
   :align: left

   ============== =============================================== 
   predicates     public                                          
   implements     :ref:`bhenk\doc2rst\tag\TagInterface::isInline` 
   inherited from :ref:`bhenk\doc2rst\tag\AbstractTag::isInline`  
   ============== =============================================== 





.. admonition:: @inheritdoc

    

   **Is this an inline tag**
   
   
   Is this an inline tag (with curly braces) or does this tag appear at the start of a line.
   
   | :tag6:`return` bool  - *true* if this is an inline link, *false* otherwise
   
   ``@inheritdoc`` from method :ref:`bhenk\doc2rst\tag\TagInterface::isInline`



.. code-block:: php

   public function isInline(): bool


| :tag6:`return` bool


----


.. _bhenk\doc2rst\tag\AbstractSimpleTag::getTagLength:

AbstractSimpleTag::getTagLength
-------------------------------

.. table::
   :widths: auto
   :align: left

   ============== =================================================== 
   predicates     public                                              
   implements     :ref:`bhenk\doc2rst\tag\TagInterface::getTagLength` 
   inherited from :ref:`bhenk\doc2rst\tag\AbstractTag::getTagLength`  
   ============== =================================================== 





.. admonition:: @inheritdoc

    

   **Get the length (in characters) of this tagname**
   
   
   
   
   | :tag6:`return` int  - length (in characters) of this tagname
   
   ``@inheritdoc`` from method :ref:`bhenk\doc2rst\tag\TagInterface::getTagLength`



.. code-block:: php

   public function getTagLength(): int


| :tag6:`return` int


----


.. _bhenk\doc2rst\tag\AbstractSimpleTag::getGroupWidth:

AbstractSimpleTag::getGroupWidth
--------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ==================================================== 
   predicates     public                                               
   implements     :ref:`bhenk\doc2rst\tag\TagInterface::getGroupWidth` 
   inherited from :ref:`bhenk\doc2rst\tag\AbstractTag::getGroupWidth`  
   ============== ==================================================== 





.. admonition:: @inheritdoc

    

   **Get the width (in characters) of the group in which this Tag will be displayed**
   
   | :tag6:`return` int  - width (in characters) or -1 if not yet set
   
   ``@inheritdoc`` from method :ref:`bhenk\doc2rst\tag\TagInterface::getGroupWidth`



.. code-block:: php

   public function getGroupWidth(): int


| :tag6:`return` int


----


.. _bhenk\doc2rst\tag\AbstractSimpleTag::setGroupWidth:

AbstractSimpleTag::setGroupWidth
--------------------------------

.. table::
   :widths: auto
   :align: left

   ============== ==================================================== 
   predicates     public                                               
   implements     :ref:`bhenk\doc2rst\tag\TagInterface::setGroupWidth` 
   inherited from :ref:`bhenk\doc2rst\tag\AbstractTag::setGroupWidth`  
   ============== ==================================================== 





.. admonition:: @inheritdoc

    

   **Set the width (in characters) of the group in which this Tag will be displayed**
   
   | :tag6:`param` int :param:`$max_width` - width (in characters)
   | :tag6:`return` void
   
   ``@inheritdoc`` from method :ref:`bhenk\doc2rst\tag\TagInterface::setGroupWidth`



.. code-block:: php

   public function setGroupWidth(
         Parameter #0 [ <required> int $max_width ]
    ): void


| :tag6:`param` int :param:`$max_width`
| :tag6:`return` void


----


.. _bhenk\doc2rst\tag\AbstractSimpleTag::toRst:

AbstractSimpleTag::toRst
------------------------

.. table::
   :widths: auto
   :align: left

   ============== ============================================ 
   predicates     public                                       
   implements     :ref:`bhenk\doc2rst\tag\TagInterface::toRst` 
   inherited from :ref:`bhenk\doc2rst\tag\AbstractTag::toRst`  
   ============== ============================================ 





.. admonition:: @inheritdoc

    

   **Express this Tag in reStructuredText**
   
   | :tag6:`return` string  - reStructuredText representation of this Tag
   
   ``@inheritdoc`` from method :ref:`bhenk\doc2rst\tag\TagInterface::toRst`



.. code-block:: php

   public function toRst(): string


| :tag6:`return` string


----

:block:`Fri, 17 Mar 2023 21:34:56 +0000` 
