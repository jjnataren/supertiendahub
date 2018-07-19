<?php

namespace backend\models;

/**
 * This is the model class for table "tbl_articulo_meli".
 *
 * @property string $sku
 * @property string $id
 * @property string $marca
 * @property string $serie
 * @property double $precio
 * @property double $precio_original
 * @property int $cambio
 * @property int $tipo_cambio
 * @property string $site_id
 * @property string $title
 * @property string $subtitle
 * @property string $seller_id
 * @property string $category_id
 * @property string $price
 * @property string $base_price
 * @property string $original_price
 * @property string $currency_id
 * @property string $initial_quantity
 * @property string $available_quantity
 * @property string $sold_quantity
 * @property string $sale_terms
 * @property string $buying_mode
 * @property string $listing_type_id
 * @property string $start_time
 * @property string $historical_start_time
 * @property string $stop_time
 * @property string $end_time
 * @property string $expiration_time
 * @property string $condition
 * @property string $permalink
 * @property string $thumbnail
 * @property string $secure_thumbnail
 * @property string $pictures
 * @property string $video_id
 * @property string $descriptions
 * @property string $accepts_mercadopago
 * @property string $non_mercado_pago_payment_methods
 * @property string $shipping
 * @property string $international_delivery_mode
 * @property string $seller_address
 * @property string $seller_contact
 * @property string $location
 * @property string $geolocation
 * @property string $coverage_areas
 * @property string $attributes
 * @property string $warnings
 * @property string $listing_source
 * @property string $variations
 * @property string $status
 * @property string $sub_status
 * @property string $tags
 * @property string $warranty
 * @property string $catalog_product_id
 * @property string $domain_id
 * @property string $tbl_articulo_melicol
 * @property string $seller_custom_field
 * @property string $tbl_articulo_melicol1
 * @property string $parent_item_id
 * @property string $differential_pricing
 * @property string $deal_ids
 * @property string $automatic_relist
 * @property string $date_created
 * @property string $last_updated
 * @property string $health
 */
class ArticuloMeli extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_articulo_meli';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['precio', 'precio_original'], 'number'],
            [['cambio', 'tipo_cambio'], 'integer'],
            [['sku', 'id', 'marca', 'serie'], 'string', 'max' => 200],
            [['site_id', 'title', 'subtitle', 'seller_id', 'category_id', 'price', 'base_price', 'original_price', 'currency_id', 'initial_quantity', 'available_quantity', 'sold_quantity', 'sale_terms', 'buying_mode', 'listing_type_id', 'start_time', 'historical_start_time', 'stop_time', 'end_time', 'expiration_time', 'condition', 'permalink', 'thumbnail', 'secure_thumbnail', 'pictures', 'video_id', 'descriptions', 'accepts_mercadopago', 'non_mercado_pago_payment_methods', 'shipping', 'international_delivery_mode', 'seller_address', 'seller_contact', 'location', 'geolocation', 'coverage_areas', 'attributes', 'warnings', 'listing_source', 'variations', 'status', 'sub_status', 'tags', 'warranty', 'catalog_product_id', 'domain_id', 'tbl_articulo_melicol', 'seller_custom_field', 'tbl_articulo_melicol1', 'parent_item_id', 'differential_pricing', 'deal_ids', 'automatic_relist', 'date_created', 'last_updated', 'health'], 'string', 'max' => 45],
            [['sku'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sku' => 'Sku',
            'id' => 'ID',
            'marca' => 'Marca',
            'serie' => 'Serie',
            'precio' => 'Precio',
            'precio_original' => 'Precio Original',
            'cambio' => 'Cambio',
            'tipo_cambio' => 'Tipo cambio',
            'site_id' => 'Site ID',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'seller_id' => 'Seller ID',
            'category_id' => 'Category ID',
            'price' => 'Price',
            'base_price' => 'Base Price',
            'original_price' => 'Original Price',
            'currency_id' => 'Currency ID',
            'initial_quantity' => 'Initial Quantity',
            'available_quantity' => 'Available Quantity',
            'sold_quantity' => 'Sold Quantity',
            'sale_terms' => 'Sale Terms',
            'buying_mode' => 'Buying Mode',
            'listing_type_id' => 'Listing Type ID',
            'start_time' => 'Start Time',
            'historical_start_time' => 'Historical Start Time',
            'stop_time' => 'Stop Time',
            'end_time' => 'End Time',
            'expiration_time' => 'Expiration Time',
            'condition' => 'Condition',
            'permalink' => 'Permalink',
            'thumbnail' => 'Thumbnail',
            'secure_thumbnail' => 'Secure Thumbnail',
            'pictures' => 'Pictures',
            'video_id' => 'Video ID',
            'descriptions' => 'Descriptions',
            'accepts_mercadopago' => 'Accepts Mercadopago',
            'non_mercado_pago_payment_methods' => 'Non Mercado Pago Payment Methods',
            'shipping' => 'Shipping',
            'international_delivery_mode' => 'International Delivery Mode',
            'seller_address' => 'Seller Address',
            'seller_contact' => 'Seller Contact',
            'location' => 'Location',
            'geolocation' => 'Geolocation',
            'coverage_areas' => 'Coverage Areas',
            'attributes' => 'Attributes',
            'warnings' => 'Warnings',
            'listing_source' => 'Listing Source',
            'variations' => 'Variations',
            'status' => 'Status',
            'sub_status' => 'Sub Status',
            'tags' => 'Tags',
            'warranty' => 'Warranty',
            'catalog_product_id' => 'Catalog Product ID',
            'domain_id' => 'Domain ID',
            'tbl_articulo_melicol' => 'Tbl Articulo Melicol',
            'seller_custom_field' => 'Seller Custom Field',
            'tbl_articulo_melicol1' => 'Tbl Articulo Melicol1',
            'parent_item_id' => 'Parent Item ID',
            'differential_pricing' => 'Differential Pricing',
            'deal_ids' => 'Deal Ids',
            'automatic_relist' => 'Automatic Relist',
            'date_created' => 'Date Created',
            'last_updated' => 'Last Updated',
            'health' => 'Health',
        ];
    }
}
