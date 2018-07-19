<?php
/**
 * Created by PhpStorm.
 * User: dreadber
 * Date: 26/05/2018
 * Time: 12:32 AM
 */

namespace backend\models;


class MeliModel implements \JsonSerializable
{

    public $site_id;

    public $title;

    public $seller_id;

    public $category_id;

    public $price;

    public $currency_id;

    public $available_quantity;

    public $buying_mode;

    public $listing_type_id;

    public $condition;

    public $description;

    public $seller_custom_field;

    public $status;

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return array_filter([
            'site_id' => $this->site_id,
            'title' => $this->title,
            'seller_id' => $this->seller_id,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'currency_id' => $this->currency_id,
            'available_quantity' => $this->available_quantity,
            'buying_mode' => $this->buying_mode,
            'listing_type_id' => $this->listing_type_id,
            'condition' => $this->condition,
            'description' => $this->description,
            'seller_custom_field' => $this->seller_custom_field,
            'status' => $this->status
        ], function ($val) {
            return null !== $val;
        });
    }
}