<?php

declare(strict_types=1);

namespace common\factories;

use common\models\ConstructionSite;
use common\structures\ConstructionSiteResponse;

class ConstructionSiteFactory
{
    public function createFromActiveRecord(ConstructionSite $site): ConstructionSiteResponse
    {
        return new ConstructionSiteResponse($site);
    }
}