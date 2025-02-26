<?php

declare(strict_types=1);

namespace common\structures;

class PagedConstructionSites
{
    public function __construct(
        public array $sites,
        public int $total,
        public int $offset,
        public int $limit,
    ) {}
}