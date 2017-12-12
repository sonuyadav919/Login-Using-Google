<?php namespace Creations\GoogleAPI;

use Backend;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;
use System\Classes\CombineAssets;
use Creations\GoogleAPI\Models\Settings;
use Event, View;
/**
 * GoogleAPI Plugin Information File
 */
class Plugin extends PluginBase
{
    public $elevated = true;

    public function boot() {

         \Backend\Controllers\Auth::extend(function($controller) {
             if(\Backend\Classes\BackendController::$action == 'signin') {

                 if(Settings::get('google_button') == 'light') {
                     $CSS[] = 'ssologin-light.css';
                 } else {
                     $CSS[] = 'ssologin.css';
                 }

                 if(Settings::get('hide_login_fields') == 1) {
                     $CSS[] = 'hide-login.css';
                 }

                 $controller->addCss(CombineAssets::combine($CSS, plugins_path() . '/creations/googleapi/assets/css/'));

             }
         });

         Event::listen('backend.auth.extendSigninView', function($controller) {
             return View::make("creations.googleapi::login")->render();
         });

     }

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Google API',
            'description' => 'Login with Google',
            'author'      => 'creations',
            'icon'        => 'icon-google'
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Creations\GoogleAPI\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */


    public function registerSettings()
    {
      return [
          'settings' => [
              'label'       => 'creations.googleapi::lang.plugin.name',
              'description' => 'creations.googleapi::lang.plugin.description',
              'icon'        => 'icon-key',
              'class'       => '\Creations\GoogleAPI\Models\Settings',
              'order'       => 800,
              'permissions' => ['creations.googleapi.access'],
              'category'    => 'system::lang.system.categories.system'
          ],
          'logs' => [
              'label'       => 'creations.googleapi::lang.plugin.name',
              'description' => 'creations.googleapi::lang.plugin.description_log',
              'icon'        => 'icon-key',
              'url'         => \Backend::url('creations/googleapi/logs'),
              'order'       => 800,
              'permissions' => ['creations.googleapi.access'],
              'category'    => SettingsManager::CATEGORY_LOGS,
          ],
      ];
    }



    public function registerPermissions()
    {
        return [
            'creations.googleapi.some_permission' => [
              'tab' => 'system::lang.permissions.name',
              'label' => 'creations.googleapi::lang.plugin.permissions'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'googleapi' => [
                'label'       => 'GoogleAPI',
                'url'         => Backend::url('creations/googleapi/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['creations.googleapi.*'],
                'order'       => 500,
            ],
        ];
    }

}
