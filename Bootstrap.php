<?php

class Shopware_Plugins_Frontend_WOTippsHTML_Bootstrap extends Shopware_Components_Plugin_Bootstrap
{
    public function getVersion()
    {
        return '1.0.6';
    }

    public function getLabel()
    {
        return 'WOTipps | HTML Komprimierung';
    }

    public function getInfo()
    {
        return [
            'version' => $this->getVersion(),
            'autor' => 'Niklas B&uuml;chner | Webseiten-Optimierungs-Tipps.de',
            'copyright' => '© 2018',
            'label' => $this->getLabel(),
            'license' => 'n.buechner@wotipps.de',
            'support' => 'n.buechner@wotipps.de',
            'link' => 'http://www.webseiten-optimierungs-tipps.de',
        ];
    }

    public function install()
    {
        $this->Form()->setElement('boolean', 'advancedMinification', [
            'value' => true,
            'label' => 'Erweiterte Minimierung',
            'description' => 'Die erweiterte Minimierung versucht die Webseite weiter zu komprimieren.'
                                 . ' Dies ist allerdings nicht mit allen Designs vertr&auml;glich.',
        ]);

        $this->subscribeEvent(
            'Enlight_Controller_Action_PreDispatch_Frontend',
            'beforeFrontedDispatch'
        );

        $this->subscribeEvent(
            'Enlight_Controller_Action_PreDispatch_Widgets',
            'beforeFrontedDispatch'
        );

        return true;
    }

    public function beforeFrontedDispatch(Enlight_Event_EventArgs $args)
    {

        // Set the template dir
        Shopware()->Template()->addPluginsDir(__DIR__ . '/Smarty/');

        if ($this->Config()->get('advancedMinification')) {
            Shopware()->Template()->loadFilter('output', 'h20161227');
        } else {
            Shopware()->Template()->loadFilter('output', 'h20161112');
        }
    }

    public function uninstall()
    {
        return true;
    }
}
