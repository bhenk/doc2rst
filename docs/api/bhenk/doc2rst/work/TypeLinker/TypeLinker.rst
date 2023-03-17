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

.. _bhenk\doc2rst\work\TypeLinker:

TypeLinker
==========

.. table::
   :widths: auto
   :align: left

   ========== ======================== 
   namespace  bhenk\\doc2rst\\work     
   predicates Cloneable | Instantiable 
   ========== ======================== 


.. contents::


----


.. _bhenk\doc2rst\work\TypeLinker::Constants:

Constants
+++++++++


.. _bhenk\doc2rst\work\TypeLinker::PHP_CLASS_NET:

TypeLinker::PHP_CLASS_NET
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   string(35) "https://www.php.net/manual/en/class" 




----


.. _bhenk\doc2rst\work\TypeLinker::PHP_METHOD_NET:

TypeLinker::PHP_METHOD_NET
--------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   string(29) "https://www.php.net/manual/en" 




----


.. _bhenk\doc2rst\work\TypeLinker::SEARCH_ENGINE:

TypeLinker::SEARCH_ENGINE
-------------------------

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   string(32) "https://www.google.com/search?q=" 




----


.. _bhenk\doc2rst\work\TypeLinker::Methods:

Methods
+++++++


.. _bhenk\doc2rst\work\TypeLinker::resolveReflectionType:

TypeLinker::resolveReflectionType
---------------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function resolveReflectionType(
         Parameter #0 [ <required> ReflectionType $reflectionType ]
    ): string


| :tag6:`param` `ReflectionType <https://www.php.net/manual/en/class.reflectiontype.php>`_ :param:`$reflectionType`
| :tag6:`return` string


----


.. _bhenk\doc2rst\work\TypeLinker::resolveMultipleFQCN:

TypeLinker::resolveMultipleFQCN
-------------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function resolveMultipleFQCN(
         Parameter #0 [ <required> array $types ]
    ): array


| :tag6:`param` array :param:`$types`
| :tag6:`return` array


----


.. _bhenk\doc2rst\work\TypeLinker::resolveFQCN:

TypeLinker::resolveFQCN
-----------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function resolveFQCN(
         Parameter #0 [ <required> ReflectionClass|string $namedType ]
         Parameter #1 [ <optional> ReflectionMethod|ReflectionClassConstant|string|null $member = NULL ]
         Parameter #2 [ <optional> ?string $description = NULL ]
    ): string


| :tag6:`param` `ReflectionClass <https://www.php.net/manual/en/class.reflectionclass.php>`_ | string :param:`$namedType`
| :tag6:`param` `ReflectionMethod <https://www.php.net/manual/en/class.reflectionmethod.php>`_ | `ReflectionClassConstant <https://www.php.net/manual/en/class.reflectionclassconstant.php>`_ | string | null :param:`$member`
| :tag6:`param` ?\ string :param:`$description`
| :tag6:`return` string


----


.. _bhenk\doc2rst\work\TypeLinker::createDocumentedClassReference:

TypeLinker::createDocumentedClassReference
------------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function createDocumentedClassReference(
         Parameter #0 [ <required> ReflectionNamedType|ReflectionClass|string $namedType ]
         Parameter #1 [ <optional> ReflectionMethod|ReflectionClassConstant|string|null $member = NULL ]
         Parameter #2 [ <optional> ?string $description = NULL ]
    ): string|bool


| :tag6:`param` `ReflectionNamedType <https://www.php.net/manual/en/class.reflectionnamedtype.php>`_ | `ReflectionClass <https://www.php.net/manual/en/class.reflectionclass.php>`_ | string :param:`$namedType`
| :tag6:`param` `ReflectionMethod <https://www.php.net/manual/en/class.reflectionmethod.php>`_ | `ReflectionClassConstant <https://www.php.net/manual/en/class.reflectionclassconstant.php>`_ | string | null :param:`$member`
| :tag6:`param` ?\ string :param:`$description`
| :tag6:`return` string | bool


----


.. _bhenk\doc2rst\work\TypeLinker::createInternalClassLink:

TypeLinker::createInternalClassLink
-----------------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function createInternalClassLink(
         Parameter #0 [ <required> ReflectionNamedType|ReflectionClass|string $namedType ]
         Parameter #1 [ <optional> ReflectionMethod|ReflectionClassConstant|string|null $member = NULL ]
    ): string|bool


| :tag6:`param` `ReflectionNamedType <https://www.php.net/manual/en/class.reflectionnamedtype.php>`_ | `ReflectionClass <https://www.php.net/manual/en/class.reflectionclass.php>`_ | string :param:`$namedType`
| :tag6:`param` `ReflectionMethod <https://www.php.net/manual/en/class.reflectionmethod.php>`_ | `ReflectionClassConstant <https://www.php.net/manual/en/class.reflectionclassconstant.php>`_ | string | null :param:`$member`
| :tag6:`return` string | bool


----


.. _bhenk\doc2rst\work\TypeLinker::createUserProvidedLink:

TypeLinker::createUserProvidedLink
----------------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function createUserProvidedLink(
         Parameter #0 [ <required> ReflectionNamedType|ReflectionClass|string $namedType ]
         Parameter #1 [ <optional> ReflectionMethod|ReflectionClassConstant|string|null $member = NULL ]
    ): string|bool


| :tag6:`param` `ReflectionNamedType <https://www.php.net/manual/en/class.reflectionnamedtype.php>`_ | `ReflectionClass <https://www.php.net/manual/en/class.reflectionclass.php>`_ | string :param:`$namedType`
| :tag6:`param` `ReflectionMethod <https://www.php.net/manual/en/class.reflectionmethod.php>`_ | `ReflectionClassConstant <https://www.php.net/manual/en/class.reflectionclassconstant.php>`_ | string | null :param:`$member`
| :tag6:`return` string | bool


----


.. _bhenk\doc2rst\work\TypeLinker::createSourceLink:

TypeLinker::createSourceLink
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function createSourceLink(
         Parameter #0 [ <required> ReflectionNamedType|ReflectionClass|string $namedType ]
         Parameter #1 [ <optional> ReflectionMethod|ReflectionClassConstant|string|null $member = NULL ]
    ): string|bool


| :tag6:`param` `ReflectionNamedType <https://www.php.net/manual/en/class.reflectionnamedtype.php>`_ | `ReflectionClass <https://www.php.net/manual/en/class.reflectionclass.php>`_ | string :param:`$namedType`
| :tag6:`param` `ReflectionMethod <https://www.php.net/manual/en/class.reflectionmethod.php>`_ | `ReflectionClassConstant <https://www.php.net/manual/en/class.reflectionclassconstant.php>`_ | string | null :param:`$member`
| :tag6:`return` string | bool


----


.. _bhenk\doc2rst\work\TypeLinker::createSearchEngineLink:

TypeLinker::createSearchEngineLink
----------------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function createSearchEngineLink(
         Parameter #0 [ <required> ReflectionNamedType|ReflectionClass|string $namedType ]
         Parameter #1 [ <optional> ReflectionMethod|ReflectionClassConstant|string|null $member = NULL ]
    ): string|bool


| :tag6:`param` `ReflectionNamedType <https://www.php.net/manual/en/class.reflectionnamedtype.php>`_ | `ReflectionClass <https://www.php.net/manual/en/class.reflectionclass.php>`_ | string :param:`$namedType`
| :tag6:`param` `ReflectionMethod <https://www.php.net/manual/en/class.reflectionmethod.php>`_ | `ReflectionClassConstant <https://www.php.net/manual/en/class.reflectionclassconstant.php>`_ | string | null :param:`$member`
| :tag6:`return` string | bool


----

:block:`Fri, 17 Mar 2023 09:36:34 +0000` 
