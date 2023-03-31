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

.. _bhenk\doc2rst\process:

process
=======

.. table::
   :widths: auto
   :align: left

   ============================ ========================================================================================================================================================================================================================================================================================================================================================== 
   Depends on                   Dependency invoked by                                                                                                                                                                                                                                                                                                                                      
   ============================ ========================================================================================================================================================================================================================================================================================================================================================== 
   :ref:`bhenk\doc2rst\format`  :ref:`bhenk\doc2rst\process\CommentLexer`                                                                                                                                                                                                                                                                                                                  
   :ref:`bhenk\doc2rst\globals` :ref:`bhenk\doc2rst\process\ClassLexer` | :ref:`bhenk\doc2rst\process\CommentOrganizer` | :ref:`bhenk\doc2rst\process\Constitution` | :ref:`bhenk\doc2rst\process\DocScout` | :ref:`bhenk\doc2rst\process\DocWorker` | :ref:`bhenk\doc2rst\process\ProcessManager` | :ref:`bhenk\doc2rst\process\SourceScout` | :ref:`bhenk\doc2rst\process\TreeWorker`    
   :ref:`bhenk\doc2rst\log`     :ref:`bhenk\doc2rst\process\AbstractLexer` | :ref:`bhenk\doc2rst\process\Constitution` | :ref:`bhenk\doc2rst\process\DocWorker` | :ref:`bhenk\doc2rst\process\FunctionLexer` | :ref:`bhenk\doc2rst\process\MethodLexer` | :ref:`bhenk\doc2rst\process\ProcessManager` | :ref:`bhenk\doc2rst\process\SourceScout` | :ref:`bhenk\doc2rst\process\TreeWorker` 
   :ref:`bhenk\doc2rst\rst`     :ref:`bhenk\doc2rst\process\ClassLexer` | :ref:`bhenk\doc2rst\process\ConstantLexer` | :ref:`bhenk\doc2rst\process\DocWorker` | :ref:`bhenk\doc2rst\process\FunctionLexer` | :ref:`bhenk\doc2rst\process\MethodLexer` | :ref:`bhenk\doc2rst\process\SourceScout` | :ref:`bhenk\doc2rst\process\TreeWorker`                                                 
   :ref:`bhenk\doc2rst\tag`     :ref:`bhenk\doc2rst\process\AbstractLexer` | :ref:`bhenk\doc2rst\process\CommentLexer` | :ref:`bhenk\doc2rst\process\CommentOrganizer` | :ref:`bhenk\doc2rst\process\FunctionLexer` | :ref:`bhenk\doc2rst\process\MethodLexer`                                                                                                                             
   :ref:`bhenk\doc2rst\work`    :ref:`bhenk\doc2rst\process\AbstractLexer` | :ref:`bhenk\doc2rst\process\ClassLexer` | :ref:`bhenk\doc2rst\process\CommentHelper` | :ref:`bhenk\doc2rst\process\ConstantLexer` | :ref:`bhenk\doc2rst\process\DocWorker` | :ref:`bhenk\doc2rst\process\FunctionLexer` | :ref:`bhenk\doc2rst\process\MethodLexer` | :ref:`bhenk\doc2rst\process\TreeWorker`  
   ============================ ========================================================================================================================================================================================================================================================================================================================================================== 


**Main processing logic**




.. toctree::
   :maxdepth: 0
   :titlesonly:
   :caption: classes

   AbstractLexer/AbstractLexer
   ClassLexer/ClassLexer
   CommentHelper/CommentHelper
   CommentLexer/CommentLexer
   CommentOrganizer/CommentOrganizer
   ConstantLexer/ConstantLexer
   Constitution/Constitution
   ConstitutionInterface/ConstitutionInterface
   DocScout/DocScout
   DocWorker/DocWorker
   FunctionLexer/FunctionLexer
   MethodLexer/MethodLexer
   ProcessManager/ProcessManager
   SourceScout/SourceScout
   TreeWorker/TreeWorker




----

:block:`Fri, 31 Mar 2023 13:14:20 +0000` 
