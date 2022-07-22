<?php

namespace SabinaTalipova\ThreeDScene\Models;

use SilverStripe\Assets\File;
use Silverstripe\ORM\DataObject;

class ThreeDSceneObject extends DataObject
{
    private static $table_name = 'ThreeDSceneObject';

    private static $db = [
        'Title' => 'Varchar',
        'Object' => "Enum(array('Box',  'Sphere', 'Capsule', 'File'), 'Box')",
    ];

    private static $has_one = [
        'Scene' => ThreeDScene::class,
        'Material' => ThreeDSceneMaterial::class,
        'File' => File::class,
    ];

}