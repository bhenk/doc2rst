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

.. _bhenk\doc2rst\log\Log:

Log
===

.. table::
   :widths: auto
   :align: left

   ========== ======================== 
   namespace  bhenk\\doc2rst\\log      
   predicates Cloneable | Instantiable 
   ========== ======================== 


.. contents::


----


.. _bhenk\doc2rst\log\Log::Methods:

Methods
~~~~~~~


.. _bhenk\doc2rst\log\Log::setEnabled:

Log::setEnabled
+++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function setEnabled(
         Parameter #0 [ <required> bool $enabled ]
    ): void


| :tag6:`param` bool :param:`$enabled`
| :tag6:`return` void


----


.. _bhenk\doc2rst\log\Log::error:

Log::error
++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function error(
         Parameter #0 [ <required> string $err ]
         Parameter #1 [ <optional> ?Throwable $e = NULL ]
         Parameter #2 [ <optional> bool $back_trace = true ]
    ): void


| :tag6:`param` string :param:`$err`
| :tag6:`param` ?\ `Throwable <https://www.php.net/manual/en/class.throwable.php>`_ :param:`$e`
| :tag6:`param` bool :param:`$back_trace`
| :tag6:`return` void


----


.. _bhenk\doc2rst\log\Log::warning:

Log::warning
++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function warning(
         Parameter #0 [ <required> string $warning ]
         Parameter #1 [ <optional> bool $back_trace = true ]
    ): void


| :tag6:`param` string :param:`$warning`
| :tag6:`param` bool :param:`$back_trace`
| :tag6:`return` void


----


.. _bhenk\doc2rst\log\Log::notice:

Log::notice
+++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function notice(
         Parameter #0 [ <required> string $out ]
         Parameter #1 [ <optional> bool $back_trace = true ]
    ): void


| :tag6:`param` string :param:`$out`
| :tag6:`param` bool :param:`$back_trace`
| :tag6:`return` void


----


.. _bhenk\doc2rst\log\Log::info:

Log::info
+++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function info(
         Parameter #0 [ <required> string $out ]
         Parameter #1 [ <optional> bool $back_trace = true ]
    ): void


| :tag6:`param` string :param:`$out`
| :tag6:`param` bool :param:`$back_trace`
| :tag6:`return` void


----


.. _bhenk\doc2rst\log\Log::debug:

Log::debug
++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function debug(
         Parameter #0 [ <required> string $out ]
         Parameter #1 [ <optional> bool $back_trace = true ]
    ): void


| :tag6:`param` string :param:`$out`
| :tag6:`param` bool :param:`$back_trace`
| :tag6:`return` void


----


.. _bhenk\doc2rst\log\Log::getErrorCount:

Log::getErrorCount
++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getErrorCount(): int


| :tag6:`return` int


----


.. _bhenk\doc2rst\log\Log::getWarningsCount:

Log::getWarningsCount
+++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getWarningsCount(): int


| :tag6:`return` int


----

:block:`no datestamp` 
