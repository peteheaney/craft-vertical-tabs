<?php
/**
 * Vertical Tabs plugin for Craft CMS 3.x
 *
 * Replace the Craft Control Panel's horizontal tabs with vertical tabs.
 *
 * @link      https://www.peteheaney.com
 * @copyright Copyright (c) 2019 Pete Heaney
 */

namespace peteheaney\verticaltabs\models;

use peteheaney\verticaltabs\VerticalTabs;

use Craft;
use craft\base\Model;

/**
 * @author    Pete Heaney
 * @package   VerticalTabs
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $vtEntries = '1';
    public $vtCategories = '1';
    public $vtUsers = '1';
}
