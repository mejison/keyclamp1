<?php

use App\PloiManager;

function ploi(): PloiManager
{
    return app(PloiManager::class);
}
