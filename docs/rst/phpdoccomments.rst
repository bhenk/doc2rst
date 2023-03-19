.. raw:: html

   <style> .tech {color:#005858; background-color:#F8F8F8; font-size: 0.9em; border:1px solid #D0D0D0;padding-left: 5px; padding-right: 5px;} </style>

.. role:: tech

PHPDocComments
==============

There are PSR standards for PHPDoc Comments and the use of tags:

* `PSR-5: PHPDoc <https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc.md>`_
* `PSR-19: PHPDoc tags <https://github.com/php-fig/fig-standards/blob/master/proposed/phpdoc-tags.md>`_

Usage of the @inheritdoc tag
++++++++++++++++++++++++++++

The :tech:`@inheritdoc` tag can appear inline and at the start of a new line in your documentation. Here are some
examples of the usage in doc2rst api-documentation:

* Single inheritance in :ref:`bhenk\doc2rst\globals\AbstractStaticContainer`.
* Multiple inheritance. Just repeat the :tech:`@inheritdoc` tag as many times as relevant. The order in which
  the inherited docs appear cannot be specified. Multiple inheritance in
  :ref:`bhenk\doc2rst\globals\RunConfiguration`.
* Inline usage in :ref:`bhenk\doc2rst\globals\RunConfiguration::reset`.








