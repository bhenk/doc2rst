<?php

namespace bhenk\doc2rst\globals;

use bhenk\doc2rst\process\Constitution;

/**
 * Holds key names for configuration of Container {@link RunConfiguration}.
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
     * The search engine url will have the `namespace\\classname` in the query parameter.
     *
     * (bool)
     */
    case link_to_search_engine;

    case download_file_ext;
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
