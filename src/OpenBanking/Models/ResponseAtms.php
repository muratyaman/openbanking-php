<?php
/**
 * File for ResponseAtms
 */

namespace OpenBanking\Models;

use OpenBanking\Models\ATM\Meta;
use OpenBanking\Models\ATM\Data;

/**
 * Class ResponseAtms
 * @package OpenBanking\Models
 */
class ResponseAtms
{

    /**
     * @var Meta
     */
    public $meta;

    /**
     * @var Data[]
     */
    public $data;

}