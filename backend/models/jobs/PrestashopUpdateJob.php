<?php

namespace backend\models\jobs;
use backend\models\ArticuloMayorista;
use backend\models\ArticuloPrestashop;
use backend\models\client\PrestashopClient;
use backend\models\client\PrestaShopWebserviceException;

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
        $articles = ArticuloMayorista::find()->all();
        $prestashop = array();
        foreach ($articles as $article) {
            try {
                $opt = array('resource' => 'products');
                $opt['reference'] = $article->sku;
                $xml = $client->get($opt)->children();

                if ($xml->children()[0] !== null) {
                    $xml = $xml->children();
                    $id = $this->xml_attribute($xml, 'id');
                    $articlePrestashop = null;
                    if (ArticuloPrestashop::findOne($article->sku) !== null) {
                        $articlePrestashop = ArticuloPrestashop::findOne($article->sku);

                        $optArticle = array('resource' => 'products', 'id' => $id);
                        $articleXml = $client->get($optArticle);

                        if ($articlePrestashop->precio !== $articleXml->price) {
                            $articlePrestashop->cambio = 1;
                        }

                    } else {
                        $articlePrestashop = new ArticuloPrestashop();
                        $articlePrestashop->sku = $article->sku;
                        $articlePrestashop->id_prestashop = $id;
                        $articlePrestashop->marca = $article->marca;
                        $articlePrestashop->serie = $article->serie;
                        $articlePrestashop->cambio = 0;
                    }

                    $prestashop[] = $articlePrestashop;
                    $articlePrestashop->save();
                }

            } catch (PrestaShopWebserviceException $e) {
            }
        }
    }
}
