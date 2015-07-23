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

        if (!symlink($uploadFile, $publishLink)) {
            throw new Exception("make symlink fail", MFilePublish::E_MAKE_SYMLINK_FAIL);
        }

        return $publishHash;
    }

    public static function getPublishHash($appSpace, $fileSpace, $fileName) {
        $publishHash = md5(serialize($appSpace, $fileSpace, $fileName));
        return $publishHash;
    }

    public static function getPublishLink($appSpace, $publishHash, $fileName) {
        $publishRoot = ModuleFileUpload::publishRoot();
        $link = sprintf('%s/%s/%s/%s/%s', $publishRoot, $appSpace, substr($publishHash, 0, 2), $publishHash, $fileName);
        return $link;
    }

}
