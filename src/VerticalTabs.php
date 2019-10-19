<?php
/**
 * Vertical Tabs plugin for Craft CMS 3.x
 *
 * Replace the Craft CP's horizontal tabs with vertical tabs.
 *
 * @link      https://www.peteheaney.com
 * @copyright Copyright (c) 2019 Pete Heaney
 */

namespace peteheaney\verticaltabs;

use peteheaney\verticaltabs\models\Settings;
use peteheaney\verticaltabs\assetbundles\verticaltabs\VerticalTabsAsset;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\events\TemplateEvent;
use craft\web\View;

use yii\base\Event;

/**
 * Class VerticalTabs
 *
 * @author    Pete Heaney
 * @package   VerticalTabs
 * @since     1.0.0
 *
 */
class VerticalTabs extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var VerticalTabs
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'vertical-tabs',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );

        // If not control panel request, bail
        if (!Craft::$app->getRequest()->getIsCpRequest()) {
            return false;
        }

        // Load CSS before template is rendered
        Event::on(
            View::class,
            View::EVENT_BEFORE_RENDER_TEMPLATE,
            function (TemplateEvent $event) {

                $settings = $this->getSettings();

                if(
                    ($settings->vtEntries && $event->template === 'entries/_edit') ||
                    ($settings->vtCategories && $event->template === 'categories/_edit') ||
                    ($settings->vtUsers && $event->template === 'users/_edit')
                ) {
                    $view = Craft::$app->getView();
                    $this->view->registerAssetBundle(VerticalTabsAsset::class);
                }
            }
        );
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'vertical-tabs/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
