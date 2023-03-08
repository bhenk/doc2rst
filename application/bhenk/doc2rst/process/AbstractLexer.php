<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace bhenk\doc2rst\process;

use bhenk\doc2rst\globals\TypeLinker;
use bhenk\doc2rst\log\Log;
use bhenk\doc2rst\tag\ParamTag;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionType;
use ReflectionUnionType;
use Stringable;
use function implode;
use function is_null;
use function str_replace;
use function strrpos;
use function substr;

abstract class AbstractLexer implements Stringable {

    private array $segments = [];

    /**
     *
     * @return string
     * @see Stringable
     *
     */
    public function __toString(): string {
        return implode(PHP_EOL, $this->segments);
    }

    /**
     * @return array
     */
    public function getSegments(): array {
        return $this->segments;
    }

    /**
     * @param array $segments
     */
    public function setSegments(array $segments): void {
        $this->segments = $segments;
    }

    public function addSegment(Stringable|string $segment): void {
        $this->segments[] = $segment;
    }

    protected function resolveReflectionType(ReflectionType $reflectionType): string {
        if ($reflectionType instanceof ReflectionNamedType) {
            $name = str_replace("\\", "",
                substr($reflectionType->getName(), strrpos($reflectionType->getName(), "\\", -1)));
            $allowsNull = ($reflectionType->allowsNull() and ($name != "null") and ($name != "mixed")) ? "?" : "";
            return $allowsNull . $name;
        } elseif ($reflectionType instanceof ReflectionUnionType) {
            $results = [];
            foreach ($reflectionType->getTypes() as $reflectionNamedType) {
                $results[] = self::resolveReflectionType($reflectionNamedType);
            }
            return implode("|", $results);
        } else {
            Log::warning("Cannot handle " . $reflectionType::class);
            return "unknown";
        }
    }

    protected function checkParameters(CommentLexer $lexer, array $params): void {
        $doc_params = [];
        /** @var ParamTag $param */
        foreach ($lexer->getCommentOrganizer()->removeTagsByName(ParamTag::TAG) as $param_tag) {
            $doc_params[$param_tag->getName()] = $param_tag;
        }
        /** @var ReflectionParameter $param */
        foreach ($params as $param) {
            $param_tag = $doc_params["$" . $param->getName()] ?? new ParamTag();
            $param_tag->setName("$" . $param->getName());
            $type = null;
            if (!is_null($param->getType())) // setTypeLess($foo) gives type == null.
                $type = TypeLinker::resolveReflectionType($param->getType());
            $param_tag->setType($type);
            $lexer->getCommentOrganizer()->addTag($param_tag);
        }
    }

}