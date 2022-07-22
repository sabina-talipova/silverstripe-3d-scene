<?php

namespace SabinaTalipova\ThreeDScene\Models;

use SilverStripe\Control\Controller;
use SilverStripe\ORM\CMSPreviewable;
use SilverStripe\ORM\DataObject;
use SabinaTalipova\ThreeDScene\Admins\ThreeDSceneAdmin;

class ThreeDScene extends DataObject implements CMSPreviewable
{
    private static $table_name = 'ThreeDScene';

    private static string $singular_name = 'ThreeDScene';

    private static string $plural_name = 'ThreeDScenes';

    private static string $description = '3D object model.';

    private static $show_unversioned_preview_link = true;

    private static $db = [
        'Title' => 'Varchar'
    ];

    private static $has_many = [
        'Object' => ThreeDSceneObject::class,
        'Light' => ThreeDSceneLight::class,
        'Camera' => ThreeDSceneCamera::class,
    ];

    public function PreviewLink($action = null)
    {
        $admin = ThreeDSceneAdmin::singleton();
        return Controller::join_links(
            $admin->Link(str_replace('\\', '-', $this->ClassName)),
            'cmsPreview',
            $this->ID
        );
    }

    public function CMSEditLink()
    {
        $admin = ThreeDSceneAdmin::singleton();
        $sanitisedClassname = str_replace('\\', '-', $this->ClassName);
        return Controller::join_links(
            $admin->Link($sanitisedClassname),
            'EditForm/field/',
            $sanitisedClassname,
            'item',
            $this->ID,
        );
    }

    public function getMimeType()
    {
        return 'text/html';
    }

    public function forTemplate()
    {
        return $this->renderWith(['type' => 'ThreeDScene', self::class]);
    }

    public function Link($action = null)
    {
        $admin = ThreeDSceneAdmin::singleton();
        return Controller::join_links(
                $admin->Link(str_replace('\\', '-', $this->ClassName)),
                'cmsPreview',
                $this->ID
        );
    }

    public function AbsoluteLink($action = null)
    {
        return '';
    }

    public function getPropsJSON(): string
    {
        return json_encode(
            [
                'object' => ThreeDSceneObject::get()->filter('SceneID', $this->ID)->column('Title'),
                // 'light' => ThreeDSceneLight::get()->filter('SceneID', $this->ID),
                // 'camera' => ThreeDSceneCamera::get()->filter('SceneID', $this->ID),
            ]
        );
    }
}