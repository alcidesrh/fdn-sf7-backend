<?php

namespace App\Attribute;

use ApiPlatform\Metadata\ApiResource;
use Attribute;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::IS_REPEATABLE)]
final class ApiResourceNoPagination extends ApiResource {

    public function __construct(...$data) {

        parent::__construct(...[...$data, 'paginationEnabled' => false]);
    }
}
