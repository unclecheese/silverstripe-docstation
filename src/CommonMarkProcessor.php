<?php


namespace SilverStripe\Docstation;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\MarkdownConverter;
use SilverStripe\Core\Injector\Injectable;

/**
 * A markdown processing implementation that uses league/commonmark
 * @package SilverStripe\Docstation
 */
class CommonMarkProcessor implements MarkdownProcessorInterface
{
    use Injectable;

    /**
     * @param string $markdown
     * @return MarkdownDocumentInterface
     */
    public function process(string $markdown): MarkdownDocumentInterface
    {
        $environment = new Environment();
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new FrontMatterExtension());
        $converter = new MarkdownConverter($environment);
        $result = $converter->convertToHtml($markdown);
        $frontMatter = [];
        if ($result instanceof RenderedContentWithFrontMatter) {
            $frontMatter = $result->getFrontMatter();
        }

        return new CommonMarkDocument(
            $result->getContent(),
            $frontMatter
        );
    }
}
