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

    public static function publish($fileHash, $appSpace, $fileSpace, $fileName) {
        $uploadFile = MFileUpload::getUploadFile($fileHash);

        $publishHash = static::getPublishHash($appSpace, $fileSpace, $fileName);
        $publishLink = self::getPublishLink($appSpace, $publishHash, $fileName);

        if (file_exists($publishLink)) {
            unlink($publishLink);
        } else {
            $path = dirname($publishLink);
            !file_exists($path) && mkdir($path, 0777, true);
        }

        if (!symlink($uploadFile, $publishLink)) {
            throw new Exception("make symlink fail", MFilePublish::E_MAKE_SYMLINK_FAIL);
        }

        return $publishHash;
    }

    public static function getPublishHash($appSpace, $fileSpace, $fileName) {
        $publishHash = md5(serialize(array($appSpace, $fileSpace, $fileName)));
        return $publishHash;
    }

    protected static function getPublishPath($appSpace, $publishHash, $fileName) {
        $path = sprintf('%s/%s/%s/%s', $appSpace, substr($publishHash, 0, 2), substr($publishHash, 2), $fileName);
        return $path;
    }

    public static function getPublishLink($appSpace, $publishHash, $fileName) {
        $publishRoot = ModuleFileUpload::publishRoot();
        $path = MFilePublish::getPublishPath($appSpace, $publishHash, $fileName);
        $link = sprintf('%s/%s', $publishRoot, $path);
        return $link;
    }

    public static function getUrl($appSpace, $publishHash, $fileName) {
        $urlRoot = ModuleFileUpload::urlRoot();
        $path = MFilePublish::getPublishPath($appSpace, $publishHash, $fileName);
        $url = sprintf('%s/%s', $urlRoot, $path);
        return $url;
    }

}
