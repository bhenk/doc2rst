<?php

namespace bhenk\doc2rst\process;

use RuntimeException;
use function file_exists;
use function file_get_contents;
use function is_null;

class PhpParser {

    private bool $initialized = false;
    private bool $inlineHtml = false;
    private bool $php = false;
    private Struct $namespace;
    private Struct $class;
    private Struct $interface;
    private Struct $trait;
    private Struct $enum;
    private Struct $return;
    private array $uses = [];
    private array $constants = [];
    private array $variables = [];
    private array $functions = [];

    function __construct() {}

    public function parseFile(string $path): void {
        if (!file_exists($path)) {
            throw new RuntimeException("File not found: " . $path);
        }
        $contents = file_get_contents($path);
        $this->parseString($contents);
    }

    public function parseString(string $contents): void {
        $tokens = token_get_all($contents, TOKEN_PARSE);
        $this->parseTokens($tokens);
    }

    public function parseTokens(array $tokens): void {
        $namespace_on = false;
        $use_on = false;
        $class_on = false;
        $interface_on = false;
        $trait_on = false;
        $enum_on = false;
        $const_on = false;
        $function_on = false;
        $doc_comment = null;
        $doc_comment_line = -1;
        foreach ($tokens as $token) {
            if (is_array($token)) {
                if ($token[0] == T_DOC_COMMENT) {
                    $doc_comment = $token[1];
                    $doc_comment_line = $token[2];
                }
                if ($token[0] == T_INLINE_HTML) $this->inlineHtml = true;
                if ($token[0] == T_OPEN_TAG) $this->php = true;
                if ($token[0] == T_NAMESPACE) $namespace_on = true;
                if ($token[0] == T_USE) $use_on = true;
                if ($token[0] == T_CLASS) $class_on = true;
                if ($token[0] == T_INTERFACE) $interface_on = true;
                if ($token[0] == T_TRAIT) $trait_on = true;
                if ($token[0] == T_ENUM) $enum_on = true;
                if ($token[0] == T_CONST) $const_on = true;
                if ($token[0] == T_FUNCTION) $function_on = true;
                if ($token[0] == T_NAME_QUALIFIED and $namespace_on) {
                    $this->namespace = new Struct($token[2], null, $token[1], $doc_comment_line, $doc_comment);
                    $doc_comment = null;
                    $doc_comment_line = -1;
                    $namespace_on = false;
                }
                if ($token[0] == T_NAME_QUALIFIED and $use_on) {
                    $this->uses[] = new Struct($token[2], "use", $token[1], $doc_comment_line, $doc_comment);
                    $doc_comment = null;
                    $doc_comment_line = -1;
                    $use_on = false;
                }
                if ($token[0] == T_STRING and $class_on) {
                    $this->class = new Struct($token[2], "class", $token[1], $doc_comment_line, $doc_comment);
                    $doc_comment = null;
                    $doc_comment_line = -1;
                    $class_on = false;
                }
                if ($token[0] == T_STRING and $interface_on) {
                    $this->interface = new Struct($token[2], "interface", $token[1], $doc_comment_line, $doc_comment);
                    $doc_comment = null;
                    $doc_comment_line = -1;
                    $interface_on = false;
                }
                if ($token[0] == T_STRING and $trait_on) {
                    $this->trait = new Struct($token[2], "trait", $token[1], $doc_comment_line, $doc_comment);
                    $doc_comment = null;
                    $doc_comment_line = -1;
                    $trait_on = false;
                }
                if ($token[0] == T_STRING and $enum_on) {
                    $this->enum = new Struct($token[2], "enum", $token[1], $doc_comment_line, $doc_comment);
                    $doc_comment = null;
                    $doc_comment_line = -1;
                    $enum_on = false;
                }
                if ($token[0] == T_STRING and $const_on) {
                    $this->constants[$token[1]] =
                        new Struct($token[2], $token[1], null, $doc_comment_line, $doc_comment);
                    // arrays are too hard to parse...
                    $doc_comment = null;
                    $doc_comment_line = -1;
                    $const_on = false;
                }
                if ($token[0] == T_STRING and $function_on) {
                    $this->functions[$token[1]] =
                        new Struct($token[2], $token[1], null, $doc_comment_line, $doc_comment);
                    $doc_comment = null;
                    $doc_comment_line = -1;
                    $function_on = false;
                }
                if ($token[0] == T_VARIABLE) {
                    $this->variables[$token[1]] =
                        new Struct($token[2], $token[1], null, $doc_comment_line, $doc_comment);
                    $doc_comment = null;
                    $doc_comment_line = -1;
                }
                if ($token[0] == T_RETURN and !is_null($doc_comment)) {
                    $this->return = new Struct($token[2], "return", null, $doc_comment_line, $doc_comment);
                    $doc_comment = null;
                    $doc_comment_line = -1;
                }
            }
        }
        $this->initialized = true;
    }

    /**
     * @return bool
     */
    public function isInitialized(): bool {
        return $this->initialized;
    }

    /**
     * @return bool
     */
    public function hasInlineHtml(): bool {
        $this->check();
        return $this->inlineHtml;
    }

    /**
     * @return bool
     */
    public function isPhp(): bool {
        $this->check();
        return $this->php;
    }

    public function isClassFile(): bool {
        $this->check();
        return isset($this->class);
    }

    public function isInterfaceFile(): bool {
        $this->check();
        return isset($this->interface);
    }

    public function isTraitFile(): bool {
        $this->check();
        return isset($this->trait);
    }

    public function isEnumFile(): bool {
        $this->check();
        return isset($this->enum);
    }

    /**
     * @return Struct|null
     */
    public function getNamespace(): ?Struct {
        $this->check();
        return $this->namespace ?? null;
    }

    /**
     * @return Struct[]
     */
    public function getUses(): array {
        $this->check();
        return $this->uses;
    }

    /**
     * @return Struct|null
     */
    public function getClass(): ?Struct {
        $this->check();
        return $this->class ?? null;
    }

    /**
     * @return Struct|null
     */
    public function getInterface(): ?Struct {
        $this->check();
        return $this->interface ?? null;
    }

    /**
     * @return Struct|null
     */
    public function getTrait(): ?Struct {
        $this->check();
        return $this->trait ?? null;
    }

    /**
     * @return Struct|null
     */
    public function getEnum(): ?Struct {
        $this->check();
        return $this->enum ?? null;
    }

    /**
     * @return Struct[]
     */
    public function getConstants(): array {
        $this->check();
        return $this->constants;
    }

    /**
     * @return Struct[]
     */
    public function getVariables(): array {
        $this->check();
        return $this->variables;
    }

    /**
     * @return Struct[]
     */
    public function getFunctions(): array {
        $this->check();
        return $this->functions;
    }

    /**
     * @return Struct|null
     */
    public function getReturn(): ?Struct {
        $this->check();
        return $this->return ?? null;
    }

    private function check(): void {
        if (!$this->initialized) {
            throw new RuntimeException("Parser is not initialized");
        }
    }

}