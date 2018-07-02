<?php

namespace backend\models\jobs;
use backend\models\Articulo;
use backend\models\ArticuloPrestashop;
use backend\models\client\PrestashopClient;
use backend\models\client\PrestaShopWebserviceException;
use backend\models\search\ArticuloPrestashopSearch;

/**
 * Class PrestashopUpdateJob.
 */
class PrestashopUpdateJob extends \yii\base\BaseObject implements \yii\queue\JobInterface
{
    /**
     * @inheritdoc
     */
    public function execute($queue)
    {
        $client = new PrestashopClient('http://sevende.tv/Tienda16/prestashop', '5V9BYMW9JKEC67C6TVVTM7DGACFMJBZZ');
        $articles = Articulo::find()->all();
        $prestashop = array();

        foreach ($articles as $article) {
            try {
                $opt = array('resource' => 'products');
                $opt['filter[reference]'] = $article->sku;
                $xml = $client->get($opt)->children();

                if ($xml->children()[0] !== null) {
                    $xml = $xml->children();
                    $id = $this->xml_attribute($xml->attributes(), 'id');
                    $articlePrestashop = null;

                    $optArticle = array('resource' => 'products', 'id' => $id);
                    $articleXml = $client->get($optArticle)->product;

                    $articlePrestashop = ArticuloPrestashopSearch::find()->where(['sku' => $article->sku])->one();
                    if ($articlePrestashop !== null) {
                        if ($article->precio !== $articlePrestashop->precio_original) {
                            $articlePrestashop->cambio = 1;
                            $prestashop[] = $articlePrestashop;
                        } else if ($articlePrestashop->cambio === 1) {
                            $prestashop[] = $articlePrestashop;
                        }
                    } else {
                        $articlePrestashop = new ArticuloPrestashop();
                        $articlePrestashop->sku = $article->sku;
                        $articlePrestashop->id_prestashop = $id;
                        $articlePrestashop->marca = $article->marca;
                        $articlePrestashop->serie = $article->serie;
                        $articlePrestashop->cambio = 1;
                        $articlePrestashop->precio = (double)$articleXml->price;
                        $articlePrestashop->precio_original = $article->precio;
                        $prestashop[] = $articlePrestashop;
                    }

                    $articlePrestashop->save();
                }
            } catch (PrestaShopWebserviceException $e) {
            }
        }
    }

    function xml_attribute($object, $attribute)
    {
        if (isset($object[$attribute])) {
            return (string)$object[$attribute];
        }
        return '';
    }

}
