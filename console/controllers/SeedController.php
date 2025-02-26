<?php

declare(strict_types=1);

namespace console\controllers;

use console\services\SeedService;
use yii\console\Controller;
use yii\console\ExitCode;

class SeedController extends Controller
{
    public function actionIndex(): int
    {
        $service = new SeedService;
        $service->seed();

        return ExitCode::OK;
    }
}