<?php


namespace SilverStripe\Docstation;

use SilverStripe\Control\Director;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Core\Manifest\ModuleResourceLoader;
use SilverStripe\Core\Path;
use InvalidArgumentException;
use Psr\Container\NotFoundExceptionInterface;

/**
 * GraphQL query and mutation resolvers
 * @package SilverStripe\Docstation
 */
class Resolver
{
    /**
     * @param $obj
     * @param array $args
     * @return array|array[]
     * @throws NotFoundExceptionInterface
     */
    public static function resolveReadDocstationDocs($obj, array $args)
    {
        $dir = $args['dir'];
        $resolvedDir = ModuleResourceLoader::singleton()->resolvePath($dir);
        $absDir = Director::is_absolute($dir) ? $dir : Path::join(BASE_PATH, $resolvedDir);

        if (!is_dir($absDir)) {
            throw new InvalidArgumentException(sprintf(
                'Dir %s is not a docs dir',
                $dir
            ));
        }

        /* @var MarkdownProcessorInterface $processor */
        $processor = Injector::inst()->get(MarkdownProcessorInterface::class);

        $files = glob($absDir . '/*.md');
        return array_map(function ($file) use ($processor) {
            $document = $processor->process(file_get_contents($file));
            $frontmatter = $document->getFrontmatter();
            $title = $frontmatter['title'] ?? basename($file, '.md');
            $sort = $frontmatter['sort'] ?? 999;
            return [
                'id' => md5($file),
                'title' => $title,
                'content' => $document->getHTML(),
                'sort' => $sort,
            ];
        }, $files);
    }
}
