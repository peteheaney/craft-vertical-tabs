<?php
/**
 * Vertical Tabs plugin for Craft CMS 3.x
 *
 * Replace the Craft Control Panel's horizontal tabs with vertical tabs.
 *
 * @link      https://www.peteheaney.com
 * @copyright Copyright (c) 2019 Pete Heaney
 */

namespace peteheaney\verticaltabs\assetbundles\VerticalTabs;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Pete Heaney
 * @package   VerticalTabs
 * @since     1.0.0
 */
class VerticalTabsAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@peteheaney/verticaltabs/assetbundles/verticaltabs/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->css = [
            'css/VerticalTabs.css',
        ];

        parent::init();
    }
}
