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

.. _bhenk\doc2rst\globals\RunConfiguration:

RunConfiguration
================

.. table::
   :widths: auto
   :align: left

   ========== ============================================================================================================================================================= 
   namespace  bhenk\\doc2rst\\globals                                                                                                                                       
   predicates Cloneable | Instantiable                                                                                                                                      
   implements `Stringable <https://www.php.net/manual/en/class.stringable.php>`_ | `ContainerInterface <https://www.google.com/search?q=Psr\Container\ContainerInterface>`_ 
   extends    :ref:`bhenk\doc2rst\globals\AbstractStaticContainer`                                                                                                          
   hierarchy  :ref:`bhenk\doc2rst\globals\RunConfiguration` -> :ref:`bhenk\doc2rst\globals\AbstractStaticContainer`                                                         
   ========== ============================================================================================================================================================= 


**Container for run-time configuration settings**



This class represents -and is loaded with- the :tech:`d2r-conf.php` file in the docs folder.
It uses the enum :ref:`bhenk\doc2rst\globals\RC` as a safeguard for correctly spelled property names.



.. admonition:: @inheritdoc

    

   **Base class for static container classes that load their values from an Array**
   
   
   
   Implementations of this abstract static container use a `UnitEnum <https://www.php.net/manual/en/class.unitenum.php>`_ to correlate their properties
   to keys in the array in a way that
   
   ..  code-block::
   
      property name == enum->name == key
      method name == [get|set] + camelcase(property name)
   
   
   
   ``@inheritdoc`` from class :ref:`bhenk\doc2rst\globals\AbstractStaticContainer`



.. admonition:: @inheritdoc

    

   **Describes the interface of a container that exposes methods to read its entries**
   
   ``@inheritdoc`` from interface `ContainerInterface <https://www.google.com/search?q=Psr\Container\ContainerInterface>`_



.. contents::


----


.. _bhenk\doc2rst\globals\RunConfiguration::Constants:

Constants
~~~~~~~~~


.. _bhenk\doc2rst\globals\RunConfiguration::DEFAULT_DOWNLOADABLES:

RunConfiguration::DEFAULT_DOWNLOADABLES
+++++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ====== 
   predicates public 
   ========== ====== 





.. code-block:: php

   array(4) { [0]=> string(4) ".txt" [1]=> string(4) ".csv" [2]=> string(3) ".js" [3]=> s ...




----


.. _bhenk\doc2rst\globals\RunConfiguration::Methods:

Methods
~~~~~~~


.. _bhenk\doc2rst\globals\RunConfiguration::enumForName:

RunConfiguration::enumForName
+++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== ================================================================= 
   predicates public | static                                                   
   implements :ref:`bhenk\doc2rst\globals\AbstractStaticContainer::enumForName` 
   ========== ================================================================= 


**Gets the RC-enum case for the corresponding RC-enum name**






.. admonition:: @inheritdoc

    

   **Returns the enum case for the given** :tagsign:`param` :tech:`$id` **or** *null* **if it does not exist**
   
   
   
   
   | :tag6:`param` string :param:`$id` - enum name
   | :tag6:`return` `UnitEnum <https://www.php.net/manual/en/class.unitenum.php>`_ | null  - enum case with the given :tagsign:`param` :tech:`$id` or *null*
   
   ``@inheritdoc`` from method :ref:`bhenk\doc2rst\globals\AbstractStaticContainer::enumForName`


| :tag4:`uses` :ref:`bhenk\doc2rst\globals\RC`


.. code-block:: php

   public static function enumForName(
         Parameter #0 [ <required> string $id ]
    ): ?UnitEnum


| :tag6:`param` string :param:`$id` - one of the names of enum cases in :ref:`bhenk\doc2rst\globals\RC`
| :tag6:`return` ?\ `UnitEnum <https://www.php.net/manual/en/class.unitenum.php>`_  - the corresponding enum case or *null* if :tagsign:`param` :tech:`$id` not an RC-name


----


.. _bhenk\doc2rst\globals\RunConfiguration::reset:

RunConfiguration::reset
+++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =========================================================== 
   predicates public | static                                             
   implements :ref:`bhenk\doc2rst\globals\AbstractStaticContainer::reset` 
   ========== =========================================================== 


**Reset properties to their defaults**


The reset action of this class is superimposed on that of the parent class:

.. admonition:: @inheritdoc

    

   **Reset the container to a neutral state (not necessarily to its original state)**
   
   
   
   
   | :tag6:`return` array  - representing the neutral state
   | :tag6:`throws` :ref:`bhenk\doc2rst\globals\ContainerException`
   
   ``@inheritdoc`` from method :ref:`bhenk\doc2rst\globals\AbstractStaticContainer::reset`



A call to reset on this class **will** reset it to its original state.



.. code-block:: php

   public static function reset(): array


| :tag6:`return` array  - the configuration as an array
| :tag6:`throws` :ref:`bhenk\doc2rst\globals\ContainerException`


----


.. _bhenk\doc2rst\globals\RunConfiguration::toString:

RunConfiguration::toString
++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function toString(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\globals\RunConfiguration::getApplicationRoot:

RunConfiguration::getApplicationRoot
++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getApplicationRoot(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\doc2rst\globals\RunConfiguration::setApplicationRoot:

RunConfiguration::setApplicationRoot
++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setApplicationRoot(
         Parameter #0 [ <required> ?string $application_root ]
    ): void


| :tag6:`param` ?\ string :param:`$application_root`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\RunConfiguration::getVendorDirectory:

RunConfiguration::getVendorDirectory
++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getVendorDirectory(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\doc2rst\globals\RunConfiguration::setVendorDirectory:

RunConfiguration::setVendorDirectory
++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setVendorDirectory(
         Parameter #0 [ <required> ?string $vendor_directory ]
    ): void


| :tag6:`param` ?\ string :param:`$vendor_directory`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\RunConfiguration::getVendorAutoload:

RunConfiguration::getVendorAutoload
+++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getVendorAutoload(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\doc2rst\globals\RunConfiguration::setVendorAutoload:

RunConfiguration::setVendorAutoload
+++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setVendorAutoload(
         Parameter #0 [ <required> ?string $vendor_autoload ]
    ): void


| :tag6:`param` ?\ string :param:`$vendor_autoload`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\RunConfiguration::getDocRoot:

RunConfiguration::getDocRoot
++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getDocRoot(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\doc2rst\globals\RunConfiguration::setDocRoot:

RunConfiguration::setDocRoot
++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setDocRoot(
         Parameter #0 [ <required> ?string $doc_root ]
    ): void


| :tag6:`param` ?\ string :param:`$doc_root`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\RunConfiguration::getApiDirectory:

RunConfiguration::getApiDirectory
+++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getApiDirectory(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\doc2rst\globals\RunConfiguration::setApiDirectory:

RunConfiguration::setApiDirectory
+++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setApiDirectory(
         Parameter #0 [ <required> ?string $api_directory ]
    ): void


| :tag6:`param` ?\ string :param:`$api_directory`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\RunConfiguration::getShowVisibility:

RunConfiguration::getShowVisibility
+++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getShowVisibility(): int


| :tag6:`return` int


----


.. _bhenk\doc2rst\globals\RunConfiguration::setShowVisibility:

RunConfiguration::setShowVisibility
+++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setShowVisibility(
         Parameter #0 [ <required> int $visibility ]
    ): void


| :tag6:`param` int :param:`$visibility`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\RunConfiguration::getLogLevel:

RunConfiguration::getLogLevel
+++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getLogLevel(): ?int


| :tag6:`return` ?\ int


----


.. _bhenk\doc2rst\globals\RunConfiguration::setLogLevel:

RunConfiguration::setLogLevel
+++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setLogLevel(
         Parameter #0 [ <required> int $log_level ]
    ): void


| :tag6:`param` int :param:`$log_level`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\RunConfiguration::getExcludes:

RunConfiguration::getExcludes
+++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getExcludes(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\globals\RunConfiguration::setExcludes:

RunConfiguration::setExcludes
+++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setExcludes(
         Parameter #0 [ <required> array $excludes ]
    ): void


| :tag6:`param` array :param:`$excludes`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\RunConfiguration::addExcluded:

RunConfiguration::addExcluded
+++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function addExcluded(
         Parameter #0 [ <required> string $path ]
    ): void


| :tag6:`param` string :param:`$path`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\RunConfiguration::getApiDocsTitle:

RunConfiguration::getApiDocsTitle
+++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getApiDocsTitle(): ?string


| :tag6:`return` ?\ string


----


.. _bhenk\doc2rst\globals\RunConfiguration::setApiDocsTitle:

RunConfiguration::setApiDocsTitle
+++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setApiDocsTitle(
         Parameter #0 [ <required> ?string $api_docs_title ]
    ): void


| :tag6:`param` ?\ string :param:`$api_docs_title`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\RunConfiguration::getToctreeMaxDepth:

RunConfiguration::getToctreeMaxDepth
++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getToctreeMaxDepth(): int


| :tag6:`return` int


----


.. _bhenk\doc2rst\globals\RunConfiguration::setToctreeMaxDepth:

RunConfiguration::setToctreeMaxDepth
++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setToctreeMaxDepth(
         Parameter #0 [ <required> int $toctree_max_depth ]
    ): void


| :tag6:`param` int :param:`$toctree_max_depth`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\RunConfiguration::getToctreeTitlesOnly:

RunConfiguration::getToctreeTitlesOnly
++++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getToctreeTitlesOnly(): bool


| :tag6:`return` bool


----


.. _bhenk\doc2rst\globals\RunConfiguration::setToctreeTitlesOnly:

RunConfiguration::setToctreeTitlesOnly
++++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setToctreeTitlesOnly(
         Parameter #0 [ <required> bool $toctree_titles_only ]
    ): void


| :tag6:`param` bool :param:`$toctree_titles_only`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\RunConfiguration::getShowClassContents:

RunConfiguration::getShowClassContents
++++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getShowClassContents(): bool


| :tag6:`return` bool


----


.. _bhenk\doc2rst\globals\RunConfiguration::setShowClassContents:

RunConfiguration::setShowClassContents
++++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setShowClassContents(
         Parameter #0 [ <required> bool $show_class_contents ]
    ): void


| :tag6:`param` bool :param:`$show_class_contents`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\RunConfiguration::getUserProvidedLinks:

RunConfiguration::getUserProvidedLinks
++++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getUserProvidedLinks(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\globals\RunConfiguration::setUserProvidedLinks:

RunConfiguration::setUserProvidedLinks
++++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setUserProvidedLinks(
         Parameter #0 [ <required> array $user_provided_links ]
    ): void


| :tag6:`param` array :param:`$user_provided_links`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\RunConfiguration::addUserProvidedLink:

RunConfiguration::addUserProvidedLink
+++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 


.. code-block:: php

   public static function addUserProvidedLink(
         Parameter #0 [ <required> string $key ]
         Parameter #1 [ <required> string $location ]
    )


| :tag5:`param` string :param:`$key`
| :tag5:`param` string :param:`$location`


----


.. _bhenk\doc2rst\globals\RunConfiguration::getLinkToSources:

RunConfiguration::getLinkToSources
++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getLinkToSources(): bool


| :tag6:`return` bool


----


.. _bhenk\doc2rst\globals\RunConfiguration::setLinkToSources:

RunConfiguration::setLinkToSources
++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setLinkToSources(
         Parameter #0 [ <required> bool $link_to_sources ]
    ): void


| :tag6:`param` bool :param:`$link_to_sources`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\RunConfiguration::getLinkToSearchEngine:

RunConfiguration::getLinkToSearchEngine
+++++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getLinkToSearchEngine(): bool


| :tag6:`return` bool


----


.. _bhenk\doc2rst\globals\RunConfiguration::setLinkToSearchEngine:

RunConfiguration::setLinkToSearchEngine
+++++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setLinkToSearchEngine(
         Parameter #0 [ <required> bool $link_to_search_engine ]
    ): void


| :tag6:`param` bool :param:`$link_to_search_engine`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\RunConfiguration::getDownloadFileExt:

RunConfiguration::getDownloadFileExt
++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getDownloadFileExt(): array


| :tag6:`return` array


----


.. _bhenk\doc2rst\globals\RunConfiguration::setDownloadFileExt:

RunConfiguration::setDownloadFileExt
++++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setDownloadFileExt(
         Parameter #0 [ <required> array $download_file_ext ]
    ): void


| :tag6:`param` array :param:`$download_file_ext`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\RunConfiguration::getShowDatestamp:

RunConfiguration::getShowDatestamp
++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function getShowDatestamp(): bool


| :tag6:`return` bool


----


.. _bhenk\doc2rst\globals\RunConfiguration::setShowDatestamp:

RunConfiguration::setShowDatestamp
++++++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ========== =============== 
   predicates public | static 
   ========== =============== 





.. code-block:: php

   public static function setShowDatestamp(
         Parameter #0 [ <required> bool $show_datestamp ]
    ): void


| :tag6:`param` bool :param:`$show_datestamp`
| :tag6:`return` void


----


.. _bhenk\doc2rst\globals\RunConfiguration::get:

RunConfiguration::get
+++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ============== ================================================================================================== 
   predicates     public                                                                                             
   implements     `ContainerInterface::get <https://www.google.com/search?q=Psr\Container\ContainerInterface::get>`_ 
   inherited from :ref:`bhenk\doc2rst\globals\AbstractStaticContainer::get`                                          
   ============== ================================================================================================== 





.. admonition:: @inheritdoc

    

   **Finds an entry of the container by its identifier and returns it**
   
   
   
   
   
   
   | :tag6:`param` string :param:`$id` - Identifier of the entry to look for.
   | :tag6:`return` mixed  - Entry.
   | :tag6:`throws` `NotFoundExceptionInterface <https://www.google.com/search?q=NotFoundExceptionInterface>`_  -  No entry was found for **this** identifier.
   | :tag6:`throws` `ContainerExceptionInterface <https://www.google.com/search?q=ContainerExceptionInterface>`_  - Error while retrieving the entry.
   
   ``@inheritdoc`` from method `ContainerInterface::get <https://www.google.com/search?q=Psr\Container\ContainerInterface::get>`_



.. code-block:: php

   public function get(
         Parameter #0 [ <required> string $id ]
    ): mixed


| :tag6:`param` string :param:`$id`
| :tag6:`return` mixed


----


.. _bhenk\doc2rst\globals\RunConfiguration::has:

RunConfiguration::has
+++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ============== ================================================================================================== 
   predicates     public                                                                                             
   implements     `ContainerInterface::has <https://www.google.com/search?q=Psr\Container\ContainerInterface::has>`_ 
   inherited from :ref:`bhenk\doc2rst\globals\AbstractStaticContainer::has`                                          
   ============== ================================================================================================== 





.. admonition:: @inheritdoc

    

   **Returns true if the container can return an entry for the given identifier**
   
   
   Returns false otherwise.
   
   `has($id)` returning true does not mean that `get($id)` will not throw an exception.
   It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
   
   
   
   | :tag6:`param` string :param:`$id` - Identifier of the entry to look for.
   | :tag6:`return` bool
   
   ``@inheritdoc`` from method `ContainerInterface::has <https://www.google.com/search?q=Psr\Container\ContainerInterface::has>`_



.. code-block:: php

   public function has(
         Parameter #0 [ <required> string $id ]
    ): bool


| :tag6:`param` string :param:`$id`
| :tag6:`return` bool


----


.. _bhenk\doc2rst\globals\RunConfiguration::__toString:

RunConfiguration::__toString
++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ============== =================================================================================== 
   predicates     public                                                                              
   implements     `Stringable::__toString <https://www.php.net/manual/en/stringable.__tostring.php>`_ 
   inherited from :ref:`bhenk\doc2rst\globals\AbstractStaticContainer::__toString`                    
   ============== =================================================================================== 


**Returns a string representation of this container**





.. code-block:: php

   public function __toString(): string


| :tag6:`return` string


----


.. _bhenk\doc2rst\globals\RunConfiguration::load:

RunConfiguration::load
++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ============== ========================================================== 
   predicates     public | static                                            
   inherited from :ref:`bhenk\doc2rst\globals\AbstractStaticContainer::load` 
   ============== ========================================================== 


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


.. _bhenk\doc2rst\globals\RunConfiguration::toArray:

RunConfiguration::toArray
+++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ============== ============================================================= 
   predicates     public | static                                               
   inherited from :ref:`bhenk\doc2rst\globals\AbstractStaticContainer::toArray` 
   ============== ============================================================= 


**Returns an array representing the container**





.. code-block:: php

   public static function toArray(): array


| :tag6:`return` array  - array representing the container


----


.. _bhenk\doc2rst\globals\RunConfiguration::getMethodName:

RunConfiguration::getMethodName
+++++++++++++++++++++++++++++++

.. table::
   :widths: auto
   :align: left

   ============== =================================================================== 
   predicates     public | static                                                     
   inherited from :ref:`bhenk\doc2rst\globals\AbstractStaticContainer::getMethodName` 
   ============== =================================================================== 


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

:block:`no datestamp` 
