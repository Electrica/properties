<?php namespace Electrica\Properties;

use Backend;
use Illuminate\Support\Facades\Event;
use Lovata\Shopaholic\Controllers\Products;
use Lovata\Shopaholic\Models\Product as ProductModel;
use Lovata\Shopaholic\Controllers\Products as ProductController;
use System\Classes\PluginBase;
use Electrica\Properties\Models\Properties as ProductProperties;

/**
 * Properties Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'Properties',
            'description' => 'No description provided yet...',
            'author' => 'Electrica',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        /**
         * @var $model ShopaholicProduct
         */
        ProductModel::extend(function ($model){
            $model->hasOne['properties'] = ['Electrica\Properties\Models\Properties'];

            $model->fillable[] = 'properties';

//            $model->addDynamicMethod('setPropertiesAttribute', function ($arValueList){
//                //dd($arValueList);
//            });

        });

        ProductController::extendFormFields(function ($form, $model, $context){

            if(!$model instanceof ProductModel){
                return;
            }

            if(!$model->exists){
                return;
            }

            ProductProperties::getFromProperties($model);

            $form->addTabFields([
                'properties[dimentions]' => [
                    'label' => 'Габариты',
                    'type' => 'text',
                    'tab' => 'Опции'
                ],
                'properties[temp_condition]' => [
                    'label' => 'Тем. режим',
                    'type' => 'text',
                    'tab' => 'Опции'
                ],
                'properties[volume]' => [
                    'label' => 'Объем',
                    'type' => 'text',
                    'tab' => 'Опции'
                ],
                'properties[power]' => [
                    'label' => 'Мощность',
                    'type' => 'text',
                    'tab' => 'Опции'
                ],
                'properties[supply]' => [
                    'label' => 'Питание',
                    'type' => 'text',
                    'tab' => 'Опции'
                ],
                'properties[production]' => [
                    'label' => 'Производство',
                    'type' => 'text',
                    'tab' => 'Опции'
                ],
                'properties[perfomance]' => [
                    'label' => 'Производительность',
                    'type' => 'text',
                    'tab' => 'Опции'
                ],
                'properties[capacity]' => [
                    'label' => 'Вместимость',
                    'type' => 'text',
                    'tab' => 'Опции'
                ],
                'properties[gas_power]' => [
                    'label' => 'Газовая мощность',
                    'type' => 'text',
                    'tab' => 'Опции'
                ],
            ], 'primary');

        });

        ProductController::extend(function($controller){
            $controller->importExportConfig = '~/plugins/electrica/properties/models/properties/import/config_import_export.yaml';
        });


    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Electrica\Properties\Components\PropertiesList' => 'PropertiesList',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'electrica.properties.some_permission' => [
                'tab' => 'Properties',
                'label' => 'Some permission'
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
            'properties' => [
                'label' => 'Properties',
                'url' => Backend::url('electrica/properties/mycontroller'),
                'icon' => 'icon-leaf',
                'permissions' => ['electrica.properties.*'],
                'order' => 500,
            ],
        ];
    }
}
