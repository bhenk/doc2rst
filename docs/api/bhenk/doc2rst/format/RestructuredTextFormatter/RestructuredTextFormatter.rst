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

.. _bhenk\doc2rst\format\RestructuredTextFormatter:

RestructuredTextFormatter
=========================

.. table::
   :widths: auto
   :align: left

   ========== ====================================================================================================== 
   namespace  bhenk\\doc2rst\\format                                                                                 
   predicates Cloneable | Instantiable                                                                               
   implements `Stringable <https://www.php.net/manual/en/class.stringable.php>`_                                     
   extends    :ref:`bhenk\doc2rst\format\AbstractFormatter`                                                          
   hierarchy  :ref:`bhenk\doc2rst\format\RestructuredTextFormatter` -> :ref:`bhenk\doc2rst\format\AbstractFormatter` 
   ========== ====================================================================================================== 


**This RestructuredTextFormatter is handling literal reStructuredText**


This formatter is started with 3 tics on a new line, followed by *rst*. Optionally this is followed by a command
followed by zero or more parameters. The block is ended with 3 tics on a new line.


.. admonition:: syntax

   .. code-block::

      ```rst [command] [...]
      .. rst instructions
      (...)
      ```


RestructuredTextFormatter for now only knows one command: :tech:`replace`. This command works similar to the
PHP-function *str_replace* and works on the contents of the block. The :tech:`replace` command takes 2
parameters: *search-string*, *replace-string*.


.. admonition:: Example

   .. code-block::

      ```rst replace & @
      .. code-block::

         &param ["Type"] $[name] [<description>]

      ```


The result:


.. code-block::

   @param ["Type"] $[name] [<description>]



In the above the tag-name :tech:`@\ param` can be in a code block of the PHPDoc, without being
mangled by
your IDE, that thinks you misplaced a tag.

Of course, you can always use *rst* directly in your PHPDocs:

..  code-block::

   .. hint:: text of special interest


Result:

.. hint:: text of special interest



.. contents::


----


.. _bhenk\doc2rst\format\RestructuredTextFormatter::Methods:

Methods
~~~~~~~


.. _bhenk\doc2rst\format\RestructuredTextFormatter::handleLine:

RestructuredTextFormatter::handleLine
+++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ========================================================= 
   predicates public                                                    
   implements :ref:`bhenk\doc2rst\format\AbstractFormatter::handleLine` 
   ========== ========================================================= 





.. admonition:: @inheritdoc

    

   **Handle a line of PHPDoc**
   
   
   As long as the formatter wants more lines it should return *true*. When it has enough it should return *false*.
   
   
   | :tag6:`param` string :param:`$line` - line to format
   | :tag6:`return` bool  - *true* if more lines are welcome, *false* otherwise
   
   ``@inheritdoc`` from method :ref:`bhenk\doc2rst\format\AbstractFormatter::handleLine`



.. code-block:: php

   public function handleLine(
         Parameter #0 [ <required> string $line ]
    ): bool


| :tag6:`param` string :param:`$line` - line of a code block
| :tag6:`return` bool  - *true* as long second and following lines do not start with 3 tics


----


.. _bhenk\doc2rst\format\RestructuredTextFormatter::addLine:

RestructuredTextFormatter::addLine
++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ============== ====================================================== 
   predicates     protected                                              
   inherited from :ref:`bhenk\doc2rst\format\AbstractFormatter::addLine` 
   ============== ====================================================== 


**Add a line to the resulting block**


.. code-block:: php

   protected function addLine(
         Parameter #0 [ <required> Stringable|string $line ]
    ): void


| :tag6:`param` `Stringable <https://www.php.net/manual/en/class.stringable.php>`_ | string :param:`$line` - the line to add
| :tag6:`return` void


----


.. _bhenk\doc2rst\format\RestructuredTextFormatter::__toString:

RestructuredTextFormatter::__toString
+++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ============== =================================================================================== 
   predicates     public                                                                              
   implements     `Stringable::__toString <https://www.php.net/manual/en/stringable.__tostring.php>`_ 
   inherited from :ref:`bhenk\doc2rst\format\AbstractFormatter::__toString`                           
   ============== =================================================================================== 


**Returns a reStructuredText representation of the contents of the block**


.. code-block:: php

   public function __toString(): string


| :tag6:`return` string  - reStructuredText representation of the contents


----


.. _bhenk\doc2rst\format\RestructuredTextFormatter::getLineCount:

RestructuredTextFormatter::getLineCount
+++++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ============== =========================================================== 
   predicates     protected                                                   
   inherited from :ref:`bhenk\doc2rst\format\AbstractFormatter::getLineCount` 
   ============== =========================================================== 





.. code-block:: php

   protected function getLineCount(): int


| :tag6:`return` int


----


.. _bhenk\doc2rst\format\RestructuredTextFormatter::increaseLineCount:

RestructuredTextFormatter::increaseLineCount
++++++++++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ============== ================================================================ 
   predicates     protected                                                        
   inherited from :ref:`bhenk\doc2rst\format\AbstractFormatter::increaseLineCount` 
   ============== ================================================================ 


.. code-block:: php

   protected function increaseLineCount(): int


| :tag6:`return` int


----

:block:`Mon, 13 Mar 2023 20:32:35 +0000` 
