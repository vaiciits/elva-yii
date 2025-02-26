<?php

declare(strict_types=1);

namespace common\structures;

use common\models\ConstructionSite;

class PagedConstructionSites
{
    /**
     * @param ConstructionSite[] $sites
     */
    public function __construct(
        public array $sites,
        public int $total,
        public int $offset,
        public int $limit,
    ) {}
}