<?php
/**
 * Created by PhpStorm.
 * User: dreadber
 * Date: 19/05/2018
 * Time: 1:19
 */

namespace backend\models\client;

use yii\authclient\OAuth2;
use yii\httpclient\Client;

class MeliOAuth2Client extends OAuth2
{

    public $userId = '';

    protected function defaultName()
    {
        return 'MeliOAuth2';
    }

    protected function defaultTitle()
    {
        return 'Cliente OAuth2 Meli';
    }

    /**
     * Initializes authenticated user attributes.
     * @return array auth user attributes.
     */
    protected function initUserAttributes()
    {
        return $this->api($this->userId, 'GET');
    }

    public function get($uri, $params=[])
    {
        if (!$this->accessToken->getIsValid()) {
            $this->refreshAccessToken($this->accessToken);
        }
        if (\count($params) > 0) {
            $uri .= '?';
            foreach ($params as $param) {
                $uri .= $param . '&';
            }
            $uri .= 'access_token=' . $this->accessToken->getToken();
        } else {
            $uri .= '?access_token=' . $this->accessToken->getToken();
        }
        return $this->createApiRequest()
            ->setUrl($uri)
            ->setMethod('GET')
            ->send();
    }

    public function edit($uri, $body)
    {
        if (!$this->accessToken->getIsValid()) {
            $this->refreshAccessToken($this->accessToken);
        }

        return $this->createApiRequest()
            ->setUrl($uri . '?access_token=' . $this->accessToken->getToken())
            ->setFormat(Client::FORMAT_JSON)
            ->setMethod('PUT')
            ->setContent($body)
            ->addHeaders(['content-type' => 'application/json'])
            ->send();

    }

    public function add($uri, $body)
    {
        if (!$this->accessToken->getIsValid()) {
            $this->refreshAccessToken($this->accessToken);
        }

        return $this->createApiRequest()
            ->setUrl($uri . '?access_token=' . $this->accessToken->getToken())
            ->setFormat(Client::FORMAT_JSON)
            ->setMethod('POST')
            ->setContent($body)
            ->addHeaders(['content-type' => 'application/json'])
            ->send();
    }

}