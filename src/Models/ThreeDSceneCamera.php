<?php

namespace SabinaTalipova\ThreeDScene\Models;

use Silverstripe\ORM\DataObject;

class ThreeDSceneCamera extends DataObject
{
    private static $table_name = 'ThreeDSceneCamera';

    private static $db = [
        'Title' => 'Varchar'
    ];

    private static $has_one = [
        'Scene' => ThreeDScene::class,
    ];
}