<?php
/**
 *
 * Filename: MFilePublish.class.php
 *
 * @author liyan
 * @since 2015 7 22
 */
class MFilePublish {

    // const E_MOVE_UPLOAD_FILE_FAIL = 0x01;

    public static function publish($fileHash, $appSpace, $fileSpace, $fileName) {
        $uploadFile = MFileUpload::getUploadFile($fileHash);
        $publishLink = self::getPublishLink($fileHash, $appSpace, $fileSpace, $fileName);
    }

    public static function getPublishLink($fileHash, $appSpace, $fileSpace, $fileName) {
        $publishRoot = ModuleFileUpload::publishRoot();
        $fileSpaceHash = md5($fileSpace);
        $link = sprintf('%s/%s/%s/%s/%s', $publishRoot, $appSpace, substr($fileSpaceHash, 0, 2), $fileSpaceHash, $fileName);
        return $link;
    }

}
