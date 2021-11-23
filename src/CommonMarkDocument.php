<?php


namespace SilverStripe\Docstation;

/**
 * Defines a markdown document as processed by league/commonmark
 * @package SilverStripe\Docstation
 */
class CommonMarkDocument implements MarkdownDocumentInterface
{
    /**
     * @var string
     */
    private $html;

    /**
     * @var array
     */
    private $frontMatter;

    /**
     * CommonMarkDocument constructor.
     * @param string $html
     * @param array $frontMatter
     */
    public function __construct(string $html, array $frontMatter = [])
    {
        $this->html = $html;
        $this->frontMatter = $frontMatter;
    }

    /**
     * @return string
     */
    public function getHTML(): string
    {
        return $this->html;
    }

    /**
     * @return array
     */
    public function getFrontmatter(): array
    {
        return $this->frontMatter;
    }
}
