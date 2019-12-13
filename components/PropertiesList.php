<?php namespace Electrica\Properties\Components;

use Cms\Classes\ComponentBase;
use Electrica\Properties\Models\Properties;

class PropertiesList extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'PropertiesList Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function getPropertiesList($obProduct)
    {
        if(!$obProduct or !is_object($obProduct)){
            return false;
        }

        if($properties = Properties::where(['product_id' => $obProduct->id])->first()){
            return $properties;
        }
    }
}
