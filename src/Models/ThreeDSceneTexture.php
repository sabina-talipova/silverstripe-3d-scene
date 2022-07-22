<?php

namespace SabinaTalipova\ThreeDScene\Models;

use SilverStripe\Assets\Image;
use Silverstripe\ORM\DataObject;

class ThreeDSceneTexture extends DataObject
{
    private static $table_name = 'ThreeDSceneTexture';

    private static $db = [
        'Title' => 'Varchar'
    ];

    private static $has_one = [
        'Image' => Image::class,
    ];

    private static $has_many = [
        'Material' => ThreeDSceneMaterial::class,
    ];
}