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

   $autoload = "{path/to/your/vendor/autoload}"
   require_once $autoload;

   $process = new ProcessManager("path/to/docs");
   $process->quickStart();

See also :ref:`bhenk\doc2rst\process\ProcessManager`.

After running :term:`quickstart` successfully, doc2rst will have left 3 files in your
:term:`doc_root` folder:

* :term:`d2r-conf.php` - Run configuration
* :term:`d2r-order.php` - Layout of PHPDocComments
* :term:`d2r-styles.txt` - css-classes etc.

.. _run_configuration:

Run configuration
+++++++++++++++++

A detailed overview of run configuration options is given in the
:ref:`RC-cases <bhenk\doc2rst\globals\RC>` enum. For now only a few options are of importance.
Check :term:`d2r-conf.php` in :term:`doc_root` and correct or set at least:

* :term:`application_root` - absolute path to your source
   Example: */home/project/src*
* :term:`vendor_directory` - absolute path to where your namespace begins
   Example */home/project/src/Acme*
* :term:`bootstrap_file` - absolute path to your bootstrap file
   Example: */home/project/docs/bootstrap.php*
   The bootstrap file is only needed when running from doc2rst.phar.
* :term:`doc_root` - absolute path to your documentation folder
   You gave it as an argument when running :term:`quickstart`.
   Example: */home/project/docs*
* :term:`api_directory` - absolute path to the folder for API-documentation
   Example: */home/project/docs/api*

That's it. You can now try and run doc2rst for real.

Run doc2rst
+++++++++++

After setting run configuration options in :term:`d2r-conf.php` you can now run doc2rst in run-mode.
In this mode, doc2rst generates the reStructuredText files and mimics the source folder
in the docs/api folder.

The next instructions assume that your documentation folder is called *docs* and that it is
situated in your project root folder.

**Run doc2rst.phar in your project-folder**.

In a terminal issue the following command:

.. code-block::

   $ ./doc2rst.phar -r ./docs


**Run with** *bhenk\\doc2rst* **as require-dev**

.. code-block::

   $process = new ProcessManager("path/to/docs");
   $process->run();

Doc2rst will generate the reStructuredText files in your :term:`api_directory`. Run
`Sphinx <https://www.sphinx-doc.org/en/master/index.html>`_ to complete the transformation
to html-pages.

.. admonition:: see also

   | `Installing Sphinx <https://www.sphinx-doc.org/en/master/usage/installation.html>`_
   | `sphinx-quickstart <https://www.sphinx-doc.org/en/master/man/sphinx-quickstart.html>`_

