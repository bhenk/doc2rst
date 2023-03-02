# Configuration file for the Sphinx documentation builder.
#
# For the full list of built-in configuration values, see the documentation:
# https://www.sphinx-doc.org/en/master/usage/configuration.html

# -- Project information -----------------------------------------------------
# https://www.sphinx-doc.org/en/master/usage/configuration.html#project-information

project = 'doc2rst'
copyright = '2023, henk van den berg'
author = 'henk van den berg'
release = '0.0'

# -- General configuration ---------------------------------------------------
# https://www.sphinx-doc.org/en/master/usage/configuration.html#general-configuration

extensions = [
    'sphinx_rtd_theme'
]

templates_path = ['_templates']
exclude_patterns = ['_build', 'Thumbs.db', '.DS_Store']



# -- Options for HTML output -------------------------------------------------
# https://www.sphinx-doc.org/en/master/usage/configuration.html#options-for-html-output

#html_theme = 'alabaster'
#html_theme = 'bizstyle'
#html_theme = 'groundwork'
#html_theme = 'insegel'
#html_theme = 'nature'
#html_theme = 'piccolo_theme'
#html_theme = 'press' # does not work
#html_theme = 'pyramid'
html_theme = 'sphinx_rtd_theme'
#html_theme = 'sphinx_book_theme'
#html_theme = 'sphinxawesome_theme'
#html_theme = 'sphinxdoc'
html_static_path = ['_static']

# - for theme awesome
#html_permalinks_icon = '<span>#</span>'

