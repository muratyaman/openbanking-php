<?php
/**
 * File for PostalAddress class
 */

namespace OpenBanking\Models\ATM;

/**
 * Class PostalAddress
 * @package OpenBanking\Models\ATM
 */
class PostalAddress
{

    /**
     * e.g. '564-568'
     * @var string
     */
    public $BuildingNumber;

    /**
     * e.g. 'Falls Road'
     * @var string
     */
    public $StreetName;

    /**
     * e.g. 'Belfast'
     * @var string
     */
    public $TownName;

    /**
     * e.g. [ 'NIR' ]
     * @var array
     */
    public $CountrySubDivision = [];

    /**
     * e.g. 'GB'
     * @var string
     */
    public $Country;

    /**
     * e.g. 'BT11 9AE'
     * @var string
     */
    public $PostCode;

    /**
     * @var \OpenBanking\Models\GeoLocation
     */
    public $GeoLocation;
}