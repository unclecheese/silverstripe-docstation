<?php


namespace SilverStripe\Docstation;

/**
 * Defines an object that contains markdown document properties
 * @package SilverStripe\Docstation
 */
interface MarkdownDocumentInterface
{
    /**
     * @return string
     */
    public function getHTML(): string;

    /**
     * @return array
     */
    public function getFrontmatter(): array;
}
