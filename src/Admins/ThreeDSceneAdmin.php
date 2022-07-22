<?php

namespace SabinaTalipova\ThreeDScene\Admins;

use SilverStripe\Admin\ModelAdmin;
use SilverStripe\View\SSViewer;
use SabinaTalipova\ThreeDScene\Models\ThreeDScene;
use SabinaTalipova\ThreeDScene\Models\ThreeDSceneMaterial;

class ThreeDSceneAdmin extends ModelAdmin
{

    private static string $url_segment = 'threed-scene-admin';

    private static string $menu_title = '3D Scene';

    private static string $menu_icon_class = 'font-icon-block-file';

    private static array $managed_models = [
        ThreeDScene::class,
        ThreeDSceneMaterial::class,
    ];

    private static $allowed_actions = [
        'cmsPreview',
    ];

    private static $url_handlers = [
        '$ModelClass/cmsPreview/$ID' => 'cmsPreview',
    ];

    public function cmsPreview()
    {
        $id = $this->urlParams['ID'];
        $obj = $this->modelClass::get_by_id($id);
        if (!$obj || !$obj->exists()) {
            return $this->httpError(404);
        }

        // Include use of a front-end theme temporarily.
        $oldThemes = SSViewer::get_themes();
        SSViewer::set_themes(SSViewer::config()->get('themes'));
        $preview = $obj->forTemplate();

        // Make sure to set back to backend themes.
        SSViewer::set_themes($oldThemes);

        return $preview;
    }
}