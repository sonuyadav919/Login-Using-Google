<?php namespace Creations\GoogleAPI\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use System\Classes\SettingsManager;
/**
 * Logs Back-end Controller
 */
class Logs extends Controller
{
    public $implement = [
        // 'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    // public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('October.System', 'system', 'settings');
        // BackendMenu::setContext('Creations.GoogleAPI', 'googleapi', 'logs');
        SettingsManager::setContext('Creations.GoogleAPI', 'logs');
    }
}
