<?php
/**
 * File for ATMService class
 */

namespace OpenBanking\Models\ATM;

/**
 * Class ATMService
 * @package OpenBanking\Models\ATM
 */
class ATMService
{

    /**
     * e.g. 'MiniStatement'
     * @var string
     */
    public $Name;

    /**
     * e.g. 'This details the last ten transactions on the account.'
     * @var string
     */
    public $Description;
}