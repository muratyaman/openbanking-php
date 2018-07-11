<?php
/**
 * Created by PhpStorm.
 * User: hacyaman
 * Date: 11/07/2018
 * Time: 11:52
 */

namespace OpenBanking\Models\ATM;


class Meta
{
    /**
     * Date string
     * e.g. '2018-01-03T12:24:05.000Z'
     * @var string
     */
    public $LastUpdated;

    /**
     * @var int
     */
    public $TotalResults;

    /**
     * e.g. 'Use of the APIs and any related data will be subject to the terms of the Open Licence and subject to terms and conditions'
     * @var string
     */
    public $Agreement;

    /**
     * URL for license
     * e.g. 'https://www.openbanking.org.uk/open-licence'
     * @var string
     */
    public $License;

    /**
     * URL for terms of use
     * e.g. 'https://www.openbanking.org.uk/terms'
     * @var string
     */
    public $TermsOfUse;
}