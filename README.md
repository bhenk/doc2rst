[![Documentation Status](https://readthedocs.org/projects/doc2rst/badge/?version=latest)](https://doc2rst.readthedocs.io/en/latest/?badge=latest)

# PHPDoc to reStructuredText

Doc2rst generates 
[reStructuredText](https://www.sphinx-doc.org/en/master/usage/restructuredtext/basics.html) 
from PHP-source trees. 
The generated reStructuredText than again can act as a source for 
[Sphinx](https://www.sphinx-doc.org/en/master/index.html), 
the versatile tool that builds -amongst others- html.

Doc2rst is written in PHP.\
Requirement: php >=8.1 \
Documentation: https://doc2rst.readthedocs.io/en/latest/index.html

## Run as phar

Download the [latest phar-file](https://github.com/bhenk/doc2rst/releases)
and place it in your project root folder. Supposing your documentation folder
is called _docs_, issue the quickstart command:
```
 ./doc2rst.phar -q ./docs
```
This will place 3 configuration files in your _docs_ folder. Inspect and
correct _docs/d2r-conf.php_ than run
```
 ./doc2rst.phar -r ./docs
```
This will generate the reStructuredText files in your _docs/api_ folder.

## Run as requirement

As you probably only need doc2rst during development you can add 
the _–dev_ option to the composer command:
```
 composer require --dev bhenk/doc2rst
```
Supposing your documentation folder is called _docs_, run quickstart to
install the configuration files in your _docs_ folder:
```
 $process = new ProcessManager("path/to/docs");  
 $process->quickStart();
```
This will place 3 configuration files in your _docs_ folder. Inspect and
correct _docs/d2r-conf.php_ than run
```
 $process = new ProcessManager("path/to/docs");  
 $process->run();
```
This will generate the reStructuredText files in your _docs/api_ folder.

## Configuration

For a detailed discussion on configuration options see 
[run configuration (RC enum)](https://doc2rst.readthedocs.io/en/latest/api/bhenk/doc2rst/globals/RC/RC.html#rc).
