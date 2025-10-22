<?php
namespace App\Services;

use App\Exceptions\Api\UploadHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadService extends BaseService
{
    /**
     * @param Request $request
     * @param $field
     * @return array
     */
    public function saveFile($file)
    {
        $size = $file->getSize();
        $ext  = $file->getClientOriginalExtension();
        //获取文件的绝对路径
        $path = $file->getRealPath();
        //定义文件名
        $filename = date('Ymdhis').'-'.rand(1000,9999).".".$ext;
        //相对路径
        $relative = config('filesystems.disks.avatar.relative');
        //存储文件。disk里面的avatar, 是 在 filesystems.php 配置的
        $file_path = $relative.'/'.$filename;
        $boolen = Storage::disk('avatar')->put($filename, file_get_contents($path));
        if ($boolen) {
            return ['url' => asset('').$file_path];
        } else {
            throw new UploadHandler(__('messages.image_upload_error'), 400);
        }
    }
}
