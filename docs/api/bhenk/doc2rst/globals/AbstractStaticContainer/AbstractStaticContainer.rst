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

.. _bhenk\doc2rst\globals\AbstractStaticContainer:

AbstractStaticContainer
=======================

.. table::
   :widths: auto
   :align: left

   ================ ================================================================================================================================ 
   namespace        bhenk\\doc2rst\\globals                                                                                                          
   predicates       Abstract                                                                                                                         
   implements       `ContainerInterface <https://www.php-fig.org/psr/psr-11/>`_ | `Stringable <https://www.php.net/manual/en/class.stringable.php>`_ 
   known subclasses :ref:`bhenk\doc2rst\globals\RunConfiguration`                                                                                    
   ================ ================================================================================================================================ 


**Base class for static container classes that load their values from an Array**



Implementations of this abstract static container use a `UnitEnum <https://www.php.net/manual/en/class.unitenum.php>`_ to correlate their properties
to keys in the array in a way that

..  code-block::

   property name == enum->name == key
   method name == [get|set] + camelcase(property name)




.. admonition:: @inheritdoc

    

   **Describes the interface of a container that exposes methods to read its entries**
   
   ``@inheritdoc`` from interface `ContainerInterface <https://www.php-fig.org/psr/psr-11/>`_



.. contents::


----


.. _bhenk\doc2rst\globals\AbstractStaticContainer::Methods:

Methods
+++++++


.. _bhenk\doc2rst\globals\AbstractStaticContainer::enumForName:

AbstractStaticContainer::enumForName
------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== ========================== 
   predicates public | static | abstract 
   ========== ========================== 


**Returns the enum case for the given** :tagsign:`param` :tech:`$id` **or** *null* **if it does not exist**





.. code-block:: php

   public static abstract function enumForName(
         Parameter #0 [ <required> string $id ]
    ): ?UnitEnum


| :tag6:`param` string :param:`$id` - enum name
| :tag6:`return` ?\ `UnitEnum <https://www.php.net/manual/en/class.unitenum.php>`_  - enum case with the given :tagsign:`param` :tech:`$id` or *null*


----


.. _bhenk\doc2rst\globals\AbstractStaticContainer::get:

AbstractStaticContainer::get
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================================================================ 
   predicates public                                                           
   implements `ContainerInterface::get <https://www.php-fig.org/psr/psr-11/>`_ 
   ========== ================================================================ 





.. admonition:: @inheritdoc

    

   **Finds an entry of the container by its identifier and returns it**
   
   
   
   
   
   
   | :tag6:`param` string :param:`$id` - Identifier of the entry to look for.
   | :tag6:`return` mixed  - Entry.
   | :tag6:`throws` `NotFoundExceptionInterface <https://www.google.com/search?q=NotFoundExceptionInterface>`_  -  No entry was found for **this** identifier.
   | :tag6:`throws` `ContainerExceptionInterface <https://www.google.com/search?q=ContainerExceptionInterface>`_  - Error while retrieving the entry.
   
   ``@inheritdoc`` from method `ContainerInterface::get <https://www.php-fig.org/psr/psr-11/>`_



.. code-block:: php

   public function get(
         Parameter #0 [ <required> string $id ]
    ): mixed


| :tag6:`param` string :param:`$id`
| :tag6:`return` mixed


----


.. _bhenk\doc2rst\globals\AbstractStaticContainer::has:

AbstractStaticContainer::has
----------------------------

.. table::
   :widths: auto
   :align: left

   ========== ================================================================ 
   predicates public                                                           
   implements `ContainerInterface::has <https://www.php-fig.org/psr/psr-11/>`_ 
   ========== ================================================================ 





.. admonition:: @inheritdoc

    

   **Returns true if the container can return an entry for the given identifier**
   
   
   Returns false otherwise.
   
   `has($id)` returning true does not mean that `get($id)` will not throw an exception.
   It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
   
   
   
   | :tag6:`param` string :param:`$id` - Identifier of the entry to look for.
   | :tag6:`return` bool
   
   ``@inheritdoc`` from method `ContainerInterface::has <https://www.php-fig.org/psr/psr-11/>`_



.. code-block:: php

   public function has(
         Parameter #0 [ <required> string $id ]
    ): bool


| :tag6:`param` string :param:`$id`
| :tag6:`return` bool


----


.. _bhenk\doc2rst\globals\AbstractStaticContainer::__toString:

AbstractStaticContainer::__toString
-----------------------------------

.. table::
   :widths: auto
   :align: left

   ========== =================================================================================== 
   predicates public                                                                              
   implements `Stringable::__toString <https://www.php.net/manual/en/stringable.__tostring.php>`_ 
   ========== =================================================================================== 


**Returns a string representation of this container**





.. code-block:: php

   public function __toString(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\globals\AbstractStaticContainer::load:

AbstractStaticContainer::load
-----------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


**Load the container with the given configuration**



Keys in the array *configuration* should correspond to the names of cases in the `UnitEnum <https://www.php.net/manual/en/class.unitenum.php>`_ given by
:ref:`bhenk\doc2rst\globals\AbstractStaticContainer::enumForName`.



.. code-block:: php

   public static function load(
         Parameter #0 [ <required> array $configuration ]
    ): void


| :tag6:`param` array :param:`$configuration`
| :tag6:`return` void
| :tag6:`throws` :ref:`bhenk\doc2rst\globals\ContainerException`  - if array in :tagsign:`param` :tech:`$configuration` not correct


----


.. _bhenk\doc2rst\globals\AbstractStaticContainer::toArray:

AbstractStaticContainer::toArray
--------------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


**Returns an array representing the container**





.. code-block:: php

   public static function toArray(): array


| :tag6:`return` array  - array representing the container


----


.. _bhenk\doc2rst\globals\AbstractStaticContainer::reset:

AbstractStaticContainer::reset
------------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


**Reset the container to a neutral state (not necessarily to its original state)**





.. code-block:: php

   public static function reset(): array


| :tag6:`return` array  - representing the neutral state
| :tag6:`throws` :ref:`bhenk\doc2rst\globals\ContainerException`


----


.. _bhenk\doc2rst\globals\AbstractStaticContainer::getMethodName:

AbstractStaticContainer::getMethodName
--------------------------------------

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


**Return the method name part corresponding to the given** :tagsign:`param` :tech:`$id`


Input of snake_like_name, output CamelCaseName:

..  code-block::

   foo_bar_name -> FooBarName





.. code-block:: php

   public static function getMethodName(
         Parameter #0 [ <required> string $id ]
    ): string


| :tag6:`param` string :param:`$id` - snake_like_name
| :tag6:`return` string  - CamelCaseName


----

:block:`Fri, 17 Mar 2023 13:21:35 +0000` 
