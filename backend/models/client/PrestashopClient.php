<?php
/**
 * Created by PhpStorm.
 * User: dreadber
 * Date: 19/05/2018
 * Time: 1:20
 */

namespace backend\models\client;


class PrestashopClient
{

    protected $url;

    protected $key;

    public function __construct($url, $key)
    {

        $this->url = $url;
        $this->key = $key;

    }

    /**
     * @param $options
     * @return \SimpleXMLElement
     * @throws PrestaShopWebserviceException
     */
    public function get($options)
    {
        if (isset($options['url'])) {
            $url = $options['url'];
        } elseif (isset($options['resource'])) {
            $url = $this->url . '/api/' . $options['resource'];
            $url_params = array();
            if (isset($options['id'])) {
                $url .= '/' . $options['id'];
            }
            $params = array('filter', 'display', 'sort', 'limit', 'id_shop', 'id_group_shop', 'schema');
            foreach ($params as $p) {
                foreach ($options as $k => $o) {
                    if (strpos($k, $p) !== false) {
                        $url_params[$k] = $options[$k];
                    }
                }
            }
            if (\count($url_params) > 0) {
                $url .= '?' . http_build_query($url_params);
            }
        } else {
            throw new PrestaShopWebserviceException('Bad parameters given');
        }
        $request = $this->executeRequest($url, array(CURLOPT_CUSTOMREQUEST => 'GET'));

        $this->checkStatusCode($request['status_code']);
        return $this->parseXML($request['response']);
    }

    /**
     * @param $url
     * @param array $curl_params
     * @return array
     * @throws PrestaShopWebserviceException
     */
    protected function executeRequest($url, array $curl_params = array())
    {
        $defaultParams = array(
            CURLOPT_HEADER => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLINFO_HEADER_OUT => TRUE,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => $this->key . ':',
            CURLOPT_HTTPHEADER => array('Expect:')
        );
        $session = curl_init($url);
        $curl_options = array();
        foreach ($defaultParams as $defkey => $defval) {
            if (isset($curl_params[$defkey])) {
                $curl_options[$defkey] = $curl_params[$defkey];
            } else {
                $curl_options[$defkey] = $defaultParams[$defkey];
            }
        }
        foreach ($curl_params as $defkey => $defval) {
            if (!isset($curl_options[$defkey])) {
                $curl_options[$defkey] = $curl_params[$defkey];
            }
        }
        curl_setopt_array($session, $curl_options);
        $response = curl_exec($session);
        $index = strpos($response, "\r\n\r\n");
        if ($index === false && $curl_params[CURLOPT_CUSTOMREQUEST] !== 'HEAD') {
            throw new PrestaShopWebserviceException('Bad HTTP response');
        }
        $header = substr($response, 0, $index);
        $body = substr($response, $index + 4);
        $headerArrayTmp = explode("\n", $header);
        $headerArray = array();
        foreach ($headerArrayTmp as &$headerItem) {
            $tmp = explode(':', $headerItem);
            $tmp = array_map('trim', $tmp);
            if (\count($tmp) === 2) {
                $headerArray[$tmp[0]] = $tmp[1];
            }
        }

        $status_code = curl_getinfo($session, CURLINFO_HTTP_CODE);
        if ($status_code === 0) {
            throw new PrestaShopWebserviceException('CURL Error: ' . curl_error($session));
        }
        curl_close($session);

        return array('status_code' => $status_code, 'response' => $body, 'header' => $header);
    }

    /**
     * @param $status_code
     * @throws PrestaShopWebserviceException
     */
    protected function checkStatusCode($status_code)
    {
        $error_label = 'This call to PrestaShop Web Services failed and returned an HTTP status of %d. That means: %s.';
        switch ($status_code) {
            case 200:
            case 201:
                break;
            case 204:
                throw new PrestaShopWebserviceException(sprintf($error_label, $status_code, 'No content'));
                break;
            case 400:
                throw new PrestaShopWebserviceException(sprintf($error_label, $status_code, 'Bad Request'));
                break;
            case 401:
                throw new PrestaShopWebserviceException(sprintf($error_label, $status_code, 'Unauthorized'));
                break;
            case 404:
                throw new PrestaShopWebserviceException(sprintf($error_label, $status_code, 'Not Found'));
                break;
            case 405:
                throw new PrestaShopWebserviceException(sprintf($error_label, $status_code, 'Method Not Allowed'));
                break;
            case 500:
                throw new PrestaShopWebserviceException(sprintf($error_label, $status_code, 'Internal Server Error'));
                break;
            default:
                throw new PrestaShopWebserviceException('This call to PrestaShop Web Services returned an unexpected HTTP status of:' . $status_code);
        }
    }

    /**
     * @param $response
     * @return \SimpleXMLElement
     * @throws PrestaShopWebserviceException
     */
    protected function parseXML($response)
    {
        if ($response !== '') {
            libxml_clear_errors();
            libxml_use_internal_errors(true);
            $xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
            if (libxml_get_errors()) {
                $msg = var_export(libxml_get_errors(), true);
                libxml_clear_errors();
                throw new PrestaShopWebserviceException('HTTP XML response is not parsable: ' . $msg);
            }
            return $xml;
        }

        throw new PrestaShopWebserviceException('HTTP response is empty');
    }

    /**
     * @param $options
     * @return \SimpleXMLElement
     * @throws PrestaShopWebserviceException
     */
    public function edit($options)
    {
        $xml = '';
        if (isset($options['url'])) {
            $url = $options['url'];
        } elseif ((isset($options['resource'], $options['id']) || isset($options['url'])) && $options['putXml']) {
            $url = ($options['url'] ?? $this->url . '/api/' . $options['resource'] . '/' . $options['id']);
            $xml = $options['putXml'];
            if (isset($options['id_shop'])) {
                $url .= '&id_shop=' . $options['id_shop'];
            }
            if (isset($options['id_group_shop'])) {
                $url .= '&id_group_shop=' . $options['id_group_shop'];
            }
        } else {
            throw new PrestaShopWebserviceException('Bad parameters given');
        }
        $request = $this->executeRequest($url, array(CURLOPT_CUSTOMREQUEST => 'PUT', CURLOPT_POSTFIELDS => $xml));
        $this->checkStatusCode($request['status_code']);
        return $this->parseXML($request['response']);
    }

    /**
     * @param $options
     * @return \SimpleXMLElement
     * @throws PrestaShopWebserviceException
     */
    public function add($options)
    {
        $xml = '';
        if (isset($options['resource'], $options['postXml']) || isset($options['url'], $options['postXml'])) {
            $url = (isset($options['resource']) ? $this->url . '/api/' . $options['resource'] : $options['url']);
            $xml = $options['postXml'];
            if (isset($options['id_shop'])) {
                $url .= '&id_shop=' . $options['id_shop'];
            }
            if (isset($options['id_group_shop'])) {
                $url .= '&id_group_shop=' . $options['id_group_shop'];
            }
        } else {
            throw new PrestaShopWebserviceException('Bad parameters given');
        }
        $request = $this->executeRequest($url, array(CURLOPT_CUSTOMREQUEST => 'POST', CURLOPT_POSTFIELDS => $xml));
        $this->checkStatusCode($request['status_code']);
        return $this->parseXML($request['response']);
    }

}