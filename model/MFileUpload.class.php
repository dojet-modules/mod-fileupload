<?php
/**
 *
 * Filename: MFileUpload.class.php
 *
 * @author liyan
 * @since 2015 7 22
 */
class MFileUpload {

    const E_MOVE_UPLOAD_FILE_FAIL = 0x01;

    public static function upload($file) {
        $hash = md5_file($file);
        $uploadFile = static::getUploadFile($hash);

        $path = dirname($uploadFile);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        if (!move_uploaded_file($file, $uploadFile)) {
            throw new Exception("move upload file failed, file={$this->file}", MFileUpload::E_MOVE_UPLOAD_FILE_FAIL);
        }

        return $hash;
    }

    public static function getUploadFile($hash) {
        $uploadRoot = ModuleFileUpload::uploadRoot();
        $file = sprintf('%s/%s/%s/%s', $uploadRoot, substr($hash, 0, 2), substr($hash, 2, 2), $hash);
        return $file;
    }

}
