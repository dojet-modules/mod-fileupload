<?php
/**
 *
 * Filename: MFilePublish.class.php
 *
 * @author liyan
 * @since 2015 7 22
 */
class MFilePublish {

    const E_MAKE_SYMLINK_FAIL = 0x01;

    public static function publish($hash, $app, $space, $fileName) {
        $publishHash = static::getPublishHash($app, $space, $fileName);
        $publishLink = static::getPublishLink($app, $publishHash, $fileName);

        if (file_exists($publishLink)) {
            unlink($publishLink);
        } else {
            $path = dirname($publishLink);
            !file_exists($path) && mkdir($path, 0777, true);
        }

        $filepath = MFileUpload::filepath($hash);
        if (!symlink($filepath, $publishLink)) {
            throw new Exception("make symlink fail", MFilePublish::E_MAKE_SYMLINK_FAIL);
        }

        return $publishHash;
    }

    public static function getUrl($app, $publishHash, $fileName) {
        $urlRoot = ModuleFileUpload::config('urlRoot');
        $path = MFilePublish::getPublishPath($app, $publishHash, $fileName);
        $url = sprintf('%s/%s', $urlRoot, $path);
        return $url;
    }

    protected static function getPublishHash($app, $space, $fileName) {
        return md5(serialize(array($app, $space, $fileName)));
    }

    protected static function getPublishPath($app, $publishHash, $fileName) {
        return sprintf('%s/%s/%s/%s', $app, substr($publishHash, 0, 2), substr($publishHash, 2), $fileName);
    }

    protected static function getPublishLink($app, $publishHash, $fileName) {
        $publishRoot = ModuleFileUpload::config('publishRoot');
        $path = MFilePublish::getPublishPath($app, $publishHash, $fileName);
        $link = sprintf('%s/%s', $publishRoot, $path);
        return $link;
    }

}
