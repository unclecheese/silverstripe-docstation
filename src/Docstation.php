<?php


namespace SilverStripe\Docstation;

use SilverStripe\Admin\LeftAndMain;

/**
 * The LeftAndMain controller for the documentation module
 * @package SilverStripe\Docstation
 */
class Docstation extends LeftAndMain
{
    /**
     * @var string
     * @config
     */
    private static $docs_dir = 'app/docs';

    /**
     * @var string
     */
    private static $menu_title = 'Docs';

    /**
     * @var string
     */
    private static $url_segment = 'docs';

    /**
     * @return string
     */
    public function DocsDir(): string
    {
        return static::config()->get('docs_dir');
    }
}
