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

.. _bhenk\doc2rst\globals\ContainerException:

ContainerException
==================

.. table::
   :widths: auto
   :align: left

   ========== ================================================================================================================================================================================================================================================== 
   namespace  bhenk\\doc2rst\\globals                                                                                                                                                                                                                            
   predicates Instantiable                                                                                                                                                                                                                                       
   implements `Stringable <https://www.php.net/manual/en/class.stringable.php>`_ | `Throwable <https://www.php.net/manual/en/class.throwable.php>`_ | `ContainerExceptionInterface <https://www.google.com/search?q=Psr\Container\ContainerExceptionInterface>`_ 
   extends    `Exception <https://www.php.net/manual/en/class.exception.php>`_                                                                                                                                                                                   
   hierarchy  :ref:`bhenk\doc2rst\globals\ContainerException` -> `Exception <https://www.php.net/manual/en/class.exception.php>`_                                                                                                                                
   ========== ================================================================================================================================================================================================================================================== 





.. admonition:: @inheritdoc

    

   **Base interface representing a generic exception in a container**
   
   ``@inheritdoc`` from interface `ContainerExceptionInterface <https://www.google.com/search?q=Psr\Container\ContainerExceptionInterface>`_



.. contents::


----


.. _bhenk\doc2rst\globals\ContainerException::Constructor:

Constructor
~~~~~~~~~~~


.. _bhenk\doc2rst\globals\ContainerException::__construct:

ContainerException::__construct
+++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ============== =================================================================================== 
   predicates     public | constructor                                                                
   inherited from `Exception::__construct <https://www.php.net/manual/en/exception.__construct.php>`_ 
   ============== =================================================================================== 


.. code-block:: php

   public function __construct(
         Parameter #0 [ <optional> string $message = "" ]
         Parameter #1 [ <optional> int $code = 0 ]
         Parameter #2 [ <optional> ?Throwable $previous = null ]
    )


| :tag5:`param` string :param:`$message`
| :tag5:`param` int :param:`$code`
| :tag5:`param` ?\ `Throwable <https://www.php.net/manual/en/class.throwable.php>`_ :param:`$previous`


----


.. _bhenk\doc2rst\globals\ContainerException::Methods:

Methods
~~~~~~~


.. _bhenk\doc2rst\globals\ContainerException::__wakeup:

ContainerException::__wakeup
++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ============== ============================================================================= 
   predicates     public                                                                        
   inherited from `Exception::__wakeup <https://www.php.net/manual/en/exception.__wakeup.php>`_ 
   ============== ============================================================================= 


.. code-block:: php

   public function __wakeup()



----


.. _bhenk\doc2rst\globals\ContainerException::getMessage:

ContainerException::getMessage
++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ============== ================================================================================= 
   predicates     public | final                                                                    
   implements     `Throwable::getMessage <https://www.php.net/manual/en/throwable.getmessage.php>`_ 
   inherited from `Exception::getMessage <https://www.php.net/manual/en/exception.getmessage.php>`_ 
   ============== ================================================================================= 


.. code-block:: php

   public final function getMessage(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\globals\ContainerException::getCode:

ContainerException::getCode
+++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ============== =========================================================================== 
   predicates     public | final                                                              
   implements     `Throwable::getCode <https://www.php.net/manual/en/throwable.getcode.php>`_ 
   inherited from `Exception::getCode <https://www.php.net/manual/en/exception.getcode.php>`_ 
   ============== =========================================================================== 


.. code-block:: php

   public final function getCode()



----


.. _bhenk\doc2rst\globals\ContainerException::getFile:

ContainerException::getFile
+++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ============== =========================================================================== 
   predicates     public | final                                                              
   implements     `Throwable::getFile <https://www.php.net/manual/en/throwable.getfile.php>`_ 
   inherited from `Exception::getFile <https://www.php.net/manual/en/exception.getfile.php>`_ 
   ============== =========================================================================== 


.. code-block:: php

   public final function getFile(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\globals\ContainerException::getLine:

ContainerException::getLine
+++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ============== =========================================================================== 
   predicates     public | final                                                              
   implements     `Throwable::getLine <https://www.php.net/manual/en/throwable.getline.php>`_ 
   inherited from `Exception::getLine <https://www.php.net/manual/en/exception.getline.php>`_ 
   ============== =========================================================================== 


.. code-block:: php

   public final function getLine(): int


| :tag6:`return` int


----


.. _bhenk\doc2rst\globals\ContainerException::getTrace:

ContainerException::getTrace
++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ============== ============================================================================= 
   predicates     public | final                                                                
   implements     `Throwable::getTrace <https://www.php.net/manual/en/throwable.gettrace.php>`_ 
   inherited from `Exception::getTrace <https://www.php.net/manual/en/exception.gettrace.php>`_ 
   ============== ============================================================================= 


.. code-block:: php

   public final function getTrace(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\globals\ContainerException::getPrevious:

ContainerException::getPrevious
+++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ============== =================================================================================== 
   predicates     public | final                                                                      
   implements     `Throwable::getPrevious <https://www.php.net/manual/en/throwable.getprevious.php>`_ 
   inherited from `Exception::getPrevious <https://www.php.net/manual/en/exception.getprevious.php>`_ 
   ============== =================================================================================== 


.. code-block:: php

   public final function getPrevious(): ?Throwable


| :tag6:`return` ?\ `Throwable <https://www.php.net/manual/en/class.throwable.php>`_


----


.. _bhenk\doc2rst\globals\ContainerException::getTraceAsString:

ContainerException::getTraceAsString
++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ============== ============================================================================================= 
   predicates     public | final                                                                                
   implements     `Throwable::getTraceAsString <https://www.php.net/manual/en/throwable.gettraceasstring.php>`_ 
   inherited from `Exception::getTraceAsString <https://www.php.net/manual/en/exception.gettraceasstring.php>`_ 
   ============== ============================================================================================= 


.. code-block:: php

   public final function getTraceAsString(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\globals\ContainerException::__toString:

ContainerException::__toString
++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ============== =================================================================================== 
   predicates     public                                                                              
   implements     `Stringable::__toString <https://www.php.net/manual/en/stringable.__tostring.php>`_ 
   inherited from `Exception::__toString <https://www.php.net/manual/en/exception.__tostring.php>`_   
   ============== =================================================================================== 


.. code-block:: php

   public function __toString(): string


| :tag6:`return` string


----

:block:`Mon, 13 Mar 2023 21:41:13 +0000` 
