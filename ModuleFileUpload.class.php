<?php
/**
 * Filename: ModuleFileUpload.class.php
 *
 * @author liyan
 * @since 2015 7 22
 */
class ModuleFileUpload extends BaseModule {

    protected static $uploadRoot;
    protected static $publishRoot;
    protected static $urlRoot;

    public static function setUploadRoot($uploadRoot) {
        self::$uploadRoot = $uploadRoot;
    }

    public static function uploadRoot() {
        return self::$uploadRoot;
    }

    public static function setPublishRoot($publishRoot) {
        self::$publishRoot = $publishRoot;
    }

    public static function publishRoot() {
        return self::$publishRoot;
    }

    public static function setUrlRoot($urlRoot) {
        self::$urlRoot = $urlRoot;
    }

    public static function urlRoot() {
        return self::$urlRoot;
    }

}
