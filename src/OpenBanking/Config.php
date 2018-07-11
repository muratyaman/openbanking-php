<?php
/**
 * File for Config class
 */

namespace OpenBanking;

/**
 * Class Config
 * @package OpenBanking
 * @see https://github.com/OpenBankingUK/opendata-api-spec-compiled/blob/master/participant_store.json
 */
class Config
{

    /**
     * @var array
     */
    private $providers = [];

    /**
     * @var array
     */
    private $banks = [];

    /**
     * @var array
     */
    private $bankNames = [
        'adamco'         => 'Adam & Company',
        'aibgb'          => 'Allied Irish Bank (GB)',
        'bankofireland'  => 'Bank of Ireland (UK)',
        'bankofscotland' => 'Bank of Scotland',
        'barclays'       => 'Barclays Bank',
        'coutts'         => 'Coutts',
        'danske'         => 'Danske Bank',
        'esme'           => 'Esme',
        'firsttrust'     => 'First Trust Bank',
        'halifax'        => 'Halifax',
        'hsbc'           => 'HSBC Group',
        'lloyds'         => 'Lloyds Bank',
        'nationwide'     => 'Nationwide Building Society',
        'natwest'        => 'NatWest',
        'rbs'            => 'Royal Bank of Scotland',
        'santanderuk'    => 'Santander UK',
        'ulster'         => 'Ulster Bank',
    ];

    /**
     * @var array
     */
    private $api = [
        'atms'                      => 'API for ATMs',
        'branches'                  => 'API for Branches',
        'personal-current-accounts' => 'API for Personal Current Accounts',
        'business-current-accounts' => 'API for Business Current Accounts',
        'unsecured-sme-loans'       => 'API for Unsecured SME Loans',
        'commercial-credit-cards'   => 'API for Commercial Credit Cards',
        //'accounts' => 'API for Accounts',
        //'payments' => 'API for Payments',
    ];

    /**
     * Config constructor
     */
    function __construct ()
    {
        $this->loadProviders();
        $this->loadBanks();
    }

    /**
     * @return array
     */
    function loadProviders ()
    {
        if (empty($this->providers)) {
            error_log(__METHOD__);
            $file            = __DIR__ . '/../../providers.json';
            $json            = file_get_contents($file);
            $this->providers = json_decode($json, $assocArray = true);
        }

        return $this->providers;
    }

    /**
     * @return array
     */
    function loadBanks()
    {
        foreach ($this->bankNames as $bankId => $bankName) {
            $bankFound = $this->findBankByName($bankName);
            if ($bankFound) {
                $bank = [
                    'id'   => $bankId,
                    'name' => $bankName,
                    'api'  => [],
                ];
                $url = $bankFound['baseUrl'];
                foreach ($this->api as $apiId => $apiName) {
                    $support = $bankFound['supportedAPIs'];
                    if (isset($support[$apiId])) {
                        $versions            = $support[$apiId];
                        $bank['api'][$apiId] = $url . '/' . $versions[0] . '/' . $apiId;
                    }
                }
                // append bank
                $this->banks[$bankId] = $bank;
            }
        }

        return $this->banks;
    }

    /**
     * @param string $name
     * @return array | null
     */
    private function findBankByName ($name)
    {
        $found = null;
        foreach($this->providers['data'] as $bank) {
            if ($bank['name'] === $name) {
                $found = $bank; break;
            }
        }

        return $found;
    }

    /**
     * @return array
     */
    function bankIds()
    {
        return array_keys($this->bankNames);
    }

    /**
     * @return array
     */
    function bankNames()
    {
        return $this->bankNames;
    }

    /**
     * @return array
     */
    function banks()
    {
        return $this->banks;
    }

    /**
     * @param string $bankId
     * @return array
     * @throws \Exception
     */
    function bank($bankId)
    {
        if (empty($this->banks[$bankId])) {
            throw new \Exception('Unknown bank ' . $bankId);
        }

        return $this->banks[$bankId];
    }

    /**
     * @param string $bankId
     * @param string $apiId
     * @return string
     * @throws \Exception
     */
    function bankApiUrl($bankId, $apiId)
    {
        $bank = $this->bank($bankId);
        if (empty($bank['api'][$apiId])) {
            throw new \Exception('Bank ' . $bankId . ' does not support ' . $apiId);
        }
        return $bank['api'][$apiId];
    }
}

