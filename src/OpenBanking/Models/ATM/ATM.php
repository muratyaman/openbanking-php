<?php


namespace OpenBanking\Models\ATM;

/**
 * Class ATM
 * @package OpenBanking\Models\ATM
 */
class ATM
{
    /**
     * e.g. '95010308'
     * @var string
     */
    public $Identification;

    /**
     * e.g. [ 'eng' ]
     * @var array
     */
    public $SupportedLanguages = [];

    /**
     * e.g. [ 'Balance', 'CashWithdrawal', 'PINActivation', 'PINChange' ]
     * @var array
     */
    public $ATMServices = [];

    /**
     * e.g. [ 'AudioCashMachine', 'AutomaticDoors', 'LevelAccess', 'WheelchairAccess' ]
     * @var array
     */
    public $Accessibility = [];

    /**
     * e.g. [ 'GBP', 'EUR' ]
     * @var array
     */
    public $SupportedCurrencies = [];

    /**
     * e.g. '£10'
     * @var string
     */
    public $MinimumPossibleAmount;

    /**
     * @var ATMService[]
     */
    public $OtherATMServices = [];

    /**
     * @var Branch
     */
    public $Branch;

    /**
     * @var Location
     */
    public $Location;
}