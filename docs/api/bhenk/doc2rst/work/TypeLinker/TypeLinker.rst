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


**Create links and references to types**


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


**Resolve ReflectionTypes to their representation as reStructuredText links and references**


This method handles `ReflectionNamedType <https://www.php.net/manual/en/class.reflectionnamedtype.php>`_ and `ReflectionUnionType <https://www.php.net/manual/en/class.reflectionuniontype.php>`_.




.. code-block:: php

   public static function resolveReflectionType(
         Parameter #0 [ <required> ReflectionType $reflectionType ]
    ): string


| :tag6:`param` `ReflectionType <https://www.php.net/manual/en/class.reflectiontype.php>`_ :param:`$reflectionType`
| :tag6:`return` string  - reStructuredText links and references


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


**Resolve multiple types to their representation as reStructuredText links and references**



The array :tagsign:`param` :tech:`$types` can consist of strings (fully qualified), `ReflectionClass <https://www.php.net/manual/en/class.reflectionclass.php>`_,
`ReflectionMethod <https://www.php.net/manual/en/class.reflectionmethod.php>`_ and `ReflectionClassConstant <https://www.php.net/manual/en/class.reflectionclassconstant.php>`_.



.. code-block:: php

   public static function resolveMultipleFQCN(
         Parameter #0 [ <required> array $types ]
    ): array


| :tag6:`param` array :param:`$types` - types to resolve
| :tag6:`return` array  - reStructuredText links and references


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


**Resolve a type to its representation as reStructuredText link or reference**



Strings given as :tagsign:`param` :tech:`$namedType` can still contain *allows null* (?) and the *or* (string|int)
symbol. Strings should be fully qualified (i.e. namespace\\class)



.. code-block:: php

   public static function resolveFQCN(
         Parameter #0 [ <required> ReflectionClass|string $namedType ]
         Parameter #1 [ <optional> ReflectionMethod|ReflectionClassConstant|string|null $member = NULL ]
         Parameter #2 [ <optional> ?string $description = NULL ]
    ): string


| :tag6:`param` `ReflectionClass <https://www.php.net/manual/en/class.reflectionclass.php>`_ | string :param:`$namedType` - Class-like
| :tag6:`param` `ReflectionMethod <https://www.php.net/manual/en/class.reflectionmethod.php>`_ | `ReflectionClassConstant <https://www.php.net/manual/en/class.reflectionclassconstant.php>`_ | string | null :param:`$member` - method or constant
| :tag6:`param` ?\ string :param:`$description` - description, visible part of link
| :tag6:`return` string  - reStructuredText link or reference


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


**Try to establish a reference to a type that's being documented**





.. code-block:: php

   public static function createDocumentedClassReference(
         Parameter #0 [ <required> ReflectionNamedType|ReflectionClass|string $namedType ]
         Parameter #1 [ <optional> ReflectionMethod|ReflectionClassConstant|string|null $member = NULL ]
         Parameter #2 [ <optional> ?string $description = NULL ]
    ): string|bool


| :tag6:`param` `ReflectionNamedType <https://www.php.net/manual/en/class.reflectionnamedtype.php>`_ | `ReflectionClass <https://www.php.net/manual/en/class.reflectionclass.php>`_ | string :param:`$namedType`
| :tag6:`param` `ReflectionMethod <https://www.php.net/manual/en/class.reflectionmethod.php>`_ | `ReflectionClassConstant <https://www.php.net/manual/en/class.reflectionclassconstant.php>`_ | string | null :param:`$member`
| :tag6:`param` ?\ string :param:`$description`
| :tag6:`return` string | bool  - *false* if it does not succeed, reference otherwise


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


**Try to establish a link to a PHP-type**


.. code-block:: php

   public static function createInternalClassLink(
         Parameter #0 [ <required> ReflectionNamedType|ReflectionClass|string $namedType ]
         Parameter #1 [ <optional> ReflectionMethod|ReflectionClassConstant|string|null $member = NULL ]
    ): string|bool


| :tag6:`param` `ReflectionNamedType <https://www.php.net/manual/en/class.reflectionnamedtype.php>`_ | `ReflectionClass <https://www.php.net/manual/en/class.reflectionclass.php>`_ | string :param:`$namedType`
| :tag6:`param` `ReflectionMethod <https://www.php.net/manual/en/class.reflectionmethod.php>`_ | `ReflectionClassConstant <https://www.php.net/manual/en/class.reflectionclassconstant.php>`_ | string | null :param:`$member`
| :tag6:`return` string | bool  - *false* if it does not succeed, link otherwise


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


**Try to establish a link, based on a user provided mapping**





.. admonition::  see also

    :ref:`bhenk\doc2rst\globals\RC::user_provided_links`


.. code-block:: php

   public static function createUserProvidedLink(
         Parameter #0 [ <required> ReflectionNamedType|ReflectionClass|string $namedType ]
         Parameter #1 [ <optional> ReflectionMethod|ReflectionClassConstant|string|null $member = NULL ]
    ): string|bool


| :tag6:`param` `ReflectionNamedType <https://www.php.net/manual/en/class.reflectionnamedtype.php>`_ | `ReflectionClass <https://www.php.net/manual/en/class.reflectionclass.php>`_ | string :param:`$namedType`
| :tag6:`param` `ReflectionMethod <https://www.php.net/manual/en/class.reflectionmethod.php>`_ | `ReflectionClassConstant <https://www.php.net/manual/en/class.reflectionclassconstant.php>`_ | string | null :param:`$member`
| :tag6:`return` string | bool  - *false* if it does not succeed, link otherwise


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


**Try to establish a** *file://* **type link to a source-file**





.. admonition::  see also

    :ref:`bhenk\doc2rst\globals\RC::link_to_sources`


.. code-block:: php

   public static function createSourceLink(
         Parameter #0 [ <required> ReflectionNamedType|ReflectionClass|string $namedType ]
         Parameter #1 [ <optional> ReflectionMethod|ReflectionClassConstant|string|null $member = NULL ]
    ): string|bool


| :tag6:`param` `ReflectionNamedType <https://www.php.net/manual/en/class.reflectionnamedtype.php>`_ | `ReflectionClass <https://www.php.net/manual/en/class.reflectionclass.php>`_ | string :param:`$namedType`
| :tag6:`param` `ReflectionMethod <https://www.php.net/manual/en/class.reflectionmethod.php>`_ | `ReflectionClassConstant <https://www.php.net/manual/en/class.reflectionclassconstant.php>`_ | string | null :param:`$member`
| :tag6:`return` string | bool  - *false* if it does not succeed, link otherwise


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


**Try and throw a type at a search engine**





.. admonition::  see also

    :ref:`bhenk\doc2rst\globals\RC::link_to_search_engine`


.. code-block:: php

   public static function createSearchEngineLink(
         Parameter #0 [ <required> ReflectionNamedType|ReflectionClass|string $namedType ]
         Parameter #1 [ <optional> ReflectionMethod|ReflectionClassConstant|string|null $member = NULL ]
    ): string|bool


| :tag6:`param` `ReflectionNamedType <https://www.php.net/manual/en/class.reflectionnamedtype.php>`_ | `ReflectionClass <https://www.php.net/manual/en/class.reflectionclass.php>`_ | string :param:`$namedType`
| :tag6:`param` `ReflectionMethod <https://www.php.net/manual/en/class.reflectionmethod.php>`_ | `ReflectionClassConstant <https://www.php.net/manual/en/class.reflectionclassconstant.php>`_ | string | null :param:`$member`
| :tag6:`return` string | bool  - *false* if the method is not allowed (according to configuration), link otherwise


----

:block:`no datestamp` 
