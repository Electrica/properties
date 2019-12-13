<?php namespace Electrica\Properties\Models;

use Model;


/**
 * Properties Model
 */
class Properties extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'electrica_properties_properties';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array 
     */
    protected $rules = [
        'product_id' => 'required'
    ];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'product' => ['Lovata\Shopaholic\Models\Product']
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public static function getFromProperties($product){

        if($product->properties){
            return $product->properties;
        }

        $properties = new Properties;
        $properties->product = $product;
        $properties->save();

        return $properties;

    }
}
