<?php
/**
 * File for API class
 */

namespace OpenBanking;

use \GuzzleHttp\Client;
use OpenBanking\Models\ResponseAtms;

/**
 * Class Api
 * @package OpenBanking
 */
class Api
{

    /**
     * @var string
     */
    private $bankId;

    /**
     * Api constructor.
     * @param string $bankId
     * @throws \Exception
     */
    function __construct ($bankId)
    {
        $this->bankId = $bankId;
        $this->config = new Config();
        $this->bank   = $this->config->bank($bankId);
    }

    /**
     * @return Client
     */
    private function _http ()
    {
        $client = new Client();
        return $client;
    }

    /**
     * @param string $apiId
     * @param string $url
     * @param array  $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    private function _get ($apiId, $url = '', $params = null)
    {
        $baseUrl = $this->config->bankApiUrl($this->bankId, $apiId);
        $fullUrl = $baseUrl . $url . ($params ? '?' . http_build_query($params) : '');

        return $this->_http()->get($fullUrl);
    }

    /**
     * @return string
     */
    private function _cacheDir ()
    {
        return __DIR__ . '/../../cache/' . $this->bankId;
    }

    /**
     * @param string $cacheFile
     * @return \stdClass | null
     */
    private function _getCache ($cacheFile)
    {
        $data = null;

        $file = $this->_cacheDir() . '/' . $cacheFile;
        if (file_exists($file)) {
            $json = file_get_contents($file);
            $data = json_decode($json, $assocArray = false);
        }

        return $data;
    }

    /**
     * @param string $cacheFile
     * @param array  $data
     * @return bool|int
     */
    private function _setCache ($cacheFile, $data)
    {
        $file = $this->_cacheDir() . '/' . $cacheFile;

        $json = json_encode($data, JSON_PRETTY_PRINT);
        return file_put_contents($file, $json);
    }

    /**
     * @param string $apiId
     * @param string $url
     * @param array  $params
     * @param string $cacheFile
     * @return \stdClass
     * @throws \Exception
     */
    private function _apiCall ($apiId, $url, $params, $cacheFile)
    {

        $cache = $this->_getCache($cacheFile);

        if ($cache) {
            $result = $cache;
        } else {
            $response = $this->_get($apiId, $url, $params);
            $json     = $response->getBody();
            $result   = json_decode($json, $assocArray = false);// return object
            $this->_setCache($cacheFile, $result);
        }

        return $result;
    }

    /**
     * Get a list of ATMs
     * @return ResponseAtms
     * @throws \Exception
     */
    function atms ()
    {
        $apiId     = 'atms';
        $url       = '';
        $params    = null;
        $cacheFile = $apiId . '.json';
        $result    = $this->_apiCall($apiId, $url, $params, $cacheFile);

        return $result;
    }

    /**
     * Get a list of branches
     * @return \stdClass
     */
    function branches ()
    {
        $apiId     = 'branches';
        $url       = '';
        $params    = null;
        $cacheFile = $apiId . '.json';
        $result    = $this->_apiCall($apiId, $url, $params, $cacheFile);

        return $result;
    }

    /**
     * Get a list of business current accounts
     * @return \stdClass
     */
    function business_current_accounts ()
    {
        $apiId     = 'business-current-accounts';
        $url       = '';
        $params    = null;
        $cacheFile = $apiId . '.json';
        $result    = $this->_apiCall($apiId, $url, $params, $cacheFile);

        return $result;
    }

    /**
     * Get a list of personal current accounts
     * @return \stdClass
     */
    function personal_current_accounts ()
    {
        $apiId     = 'personal-current-accounts';
        $url       = '';
        $params    = null;
        $cacheFile = $apiId . '.json';
        $result    = $this->_apiCall($apiId, $url, $params, $cacheFile);

        return $result;
    }

    /**
     * Get a list of commercial credit cards
     * @return \stdClass
     */
    function commercial_credit_cards ()
    {
        $apiId     = 'commercial-credit-cards';
        $url       = '';
        $params    = null;
        $cacheFile = $apiId . '.json';
        $result    = $this->_apiCall($apiId, $url, $params, $cacheFile);

        return $result;
    }

    /**
     * Get a list of unsecured SME loans
     * @return \stdClass
     */
    function unsecured_sme_loans ()
    {
        $apiId     = 'unsecured-sme-loans';
        $url       = '';
        $params    = null;
        $cacheFile = $apiId . '.json';
        $result    = $this->_apiCall($apiId, $url, $params, $cacheFile);

        return $result;
    }

}