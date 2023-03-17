Running doc2rst
===============

.. contents::

Doc2rst has two modes of running, :term:`quickstart`, that will initiate configuration files in the
:term:`doc_root` folder, and :term:`run`, do the generation of reStructuredText. It is most convenient
to start with a :term:`quickstart` run, it will do best guesses on the structure of your project and installs
configuration files in your :term:`doc_root` folder in order for you to inspect and correct.

Quickstart
++++++++++

The next instructions assume that your documentation folder is called *docs* and that it is situated in your
project root folder.

**Quickstart with doc2rst.phar in your project-folder**.

Open a terminal in your project folder and issue the following command:

.. code-block::

   $ ./doc2rst.phar -q ./docs

**Quickstart with** *bhenk\\doc2rst* **as require-dev in composer**.

Execute following code:

.. code-block::

   <?php
   use bhenk\doc2rst\process\ProcessManager;

   $process = new ProcessManager("path/to/docs");
   $process->quickStart();

See also :ref:`bhenk\doc2rst\process\ProcessManager`.
