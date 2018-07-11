<?php
/**
 * File for Location class
 */

namespace OpenBanking\Models\ATM;

/**
 * Class Location
 * @package OpenBanking\Models\ATM
 */
class Location
{
    /**
     * e.g. [ 'BranchInternal' ]
     * @var array
     */
    public $LocationCategory = [];

    /**
     * @var Site
     */
    public $Site;

    /**
     * @var PostalAddress
     */
    public $PostalAddress;
}