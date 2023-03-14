<?php

namespace bhenk\doc2rst\globals;

use bhenk\doc2rst\process\Constitution;
use bhenk\doc2rst\process\ProcessManager;
use ReflectionMethod;

/**
 * Holds property names for configuration of Container {@link RunConfiguration}.
 *
 * The *names* of cases in this enum correspond to keys in the :tech:`d2r-conf.php` configuration file,
 * found in your { {@link bhenk\doc2rst\globals\RC::doc_root doc_root} } directory after running
 * {@link ProcessManager::quickStart()}.
 *
 */
enum RC {

    /**
     * The source directory, usually indicated with names like *src* or *application*
     *
     * (string)
     * ```rst
     * .. admonition:: For autoconfiguration:
     *
     *    .. code-block::
     *
     *       project_directory/application_root
     * ```
     * @link Constitution::autoFindApplicationRoot()
     */
    case application_root;
    /**
     * The vendor directory or first part of namespace
     *
     * (string)
     * ```rst
     * .. admonition:: For autoconfiguration:
     *
     *    .. code-block::
     *
     *       project_directory/application_root/vendor_directory
     * ```
     * @link Constitution::autoFindVendor()
     */
    case vendor_directory;
    /**
     * The documentation directory; autoconfiguration is computed from this directory.
     *
     * (string)
     * ```rst
     * .. admonition:: For autoconfiguration:
     *
     *    .. code-block::
     *
     *       project_directory/doc_root
     * ```
     */
    case doc_root;
    /**
     * The directory for api-documentation.
     *
     * (string)
     * ```rst
     * .. admonition:: For autoconfiguration:
     *
     *    .. code-block::
     *
     *       project_directory/doc_root/api_directory
     * ```
     */
    case api_directory;
    /**
     * Title of the root entry in the generated api-documentation.
     *
     * (string)
     */
    case api_docs_title;
    /**
     * Specify which members will be documented.
     *
     * (int)
     *
     * The integer corresponds to -and can be expressed as- the constants for visibility found in
     * {@link https://www.php.net/manual/en/class.reflectionmethod.php#reflectionmethod.constants.modifiers ReflectionMethod Modifiers}:
     *
     * * {@link ReflectionMethod::IS_PUBLIC} (1)
     * * {@link ReflectionMethod::IS_PROTECTED} (2)
     * * {@link ReflectionMethod::IS_PRIVATE} (4)
     * * {@link ReflectionMethod::IS_STATIC} (16)
     * * {@link ReflectionMethod::IS_FINAL} (32)
     * * {@link ReflectionMethod::IS_ABSTRACT} (64)
     *
     * .. hint::
     *    The values of these constants may change between PHP versions.
     *    It is recommended to always use the constants and not rely on the values directly.
     *
     * It is perfectly alright to run doc2rst with *show_visibility* set to any possible number,
     * though doc2rst may not be able
     * to resolve all internal links (because some targets are absent after running with such visibility limitations).
     * Best practice for communicating your library remains to document public and protected members.
     *
     * ```
     * show_visibility = ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_PROTECTED
     * ```
     */
    case show_visibility;
    /**
     * Array of (parts of) namespaces and classes to exclude from documentation.
     *
     * (array)
     *
     * To exclude complete branches, it is enough to exclude the root of that branch.
     * To exclude individual classes, the fully qualified name of the class should be given
     */
    case excludes;
    /**
     * Level of logging during generation of documentation.
     *
     * (int)
     *
     * Log level expressed as int, interval 100:
     * ```
     * error always, warning <= 400, notice <= 300, info <= 200, debug <= 100
     * ```
     */
    case log_level;
    /**
     * Max depth for the toctree directive.
     *
     * (int)
     *
     * @see https://www.sphinx-doc.org/en/master/usage/restructuredtext/directives.html#directive-toctree toctree maxdepth
     */
    case toctree_max_depth;
    /**
     * Only document titles should show up in the toctree, not other headings.
     *
     * (bool)
     *
     * @see https://www.sphinx-doc.org/en/master/usage/restructuredtext/directives.html#directive-toctree toctree titlesonly
     */
    case toctree_titles_only;
    /**
     * Should a table of contents appear at the top of the class documentation.
     *
     * (bool)
     */
    case show_class_contents;
    /**
     * User provided mapping of `namespace\\classname` to links that give access to documentation on these types.
     *
     * Classes in external libraries cannot be linked to their documentation automatically.
     *
     * (array)
     */
    case user_provided_links;
    /**
     * If no documentation of `namespace\\classname` can be found, should a link to the (local) source file be provided.
     *
     * Classes in external libraries can be linked to their local source files.
     *
     * (bool)
     *
     */
    case link_to_sources;
    /**
     * If no documentation on `namespace\\classname` can be found, should a link to a search engine be provided.
     *
     * (bool)
     *
     * The search engine url will have the `namespace\\classname` in the query parameter.
     *
     *
     */
    case link_to_search_engine;
    /**
     * Downloadable file extension list
     *
     * (array)
     *
     * If files with these extensions are found in the source tree, they will be made downloadable from the
     * :term:`package documentation page` under the heading **downloads**.
     *
     * .. hint::
     *    It is also possible to add individual files to the **downloads** section of the package documentation page.
     *
     *    | See :term:`package.rst`
     *
     */
    case download_file_ext;
    /**
     * Prevent or allow datestamp
     *
     * (bool)
     *
     * Each page in the generated documentation gets a datestamp at the foot of the page. It shows when the
     * rst-file (not the html-file) was generated. This can be a nuisance during development and the use of
     * VCR's. Each time you generate documentation the datestamp will differ and consequently your VCR
     * sees that as changes in the file and wants you to commit the changes. In order to prevent this set
     * *show_datestamp* to *false*.
     */
    case show_datestamp;

    /**
     * Gets the enum case for the given name or *null* if it doesn't exist.
     *
     * @param string $name
     * @return RC|null
     */
    public static function forName(string $name): ?RC {
        foreach (RC::cases() as $case) {
            if ($case->name == $name) {
                return $case;
            }
        }
        return null;
    }

}
