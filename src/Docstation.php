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
     */
    private static $menu_title = 'Docs';

    /**
     * @var string
     */
    private static $url_segment = 'docs';
}
