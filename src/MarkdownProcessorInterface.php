<?php


namespace SilverStripe\Docstation;

/**
 * Defines a service that can process markdown content
 * @package SilverStripe\Docstation
 */
interface MarkdownProcessorInterface
{
    /**
     * @param string $markdown
     * @return MarkdownDocumentInterface
     */
    public function process(string $markdown): MarkdownDocumentInterface;
}
