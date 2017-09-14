<?php

namespace App\Http\Controllers\Backend\Api;


use App\Exceptions\ResourceException;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ImageController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload(Request $request)
    {
        $config = config('images');
        $image = $request->file($config['upload_key']);
        if (!is_null($image) && $image->isValid()) {
            $image->hashName($image);
            $hashName = $this->hashName($image);
            $image->storeAs($config['source_path_prefix'], $hashName, ['disk' => $config['source_disk']]);

            $imageId = ltrim(strstr($hashName, DIRECTORY_SEPARATOR), DIRECTORY_SEPARATOR);
            return [
                'image' => $imageId,
                'image_url' => route(config('images.route_name'), $imageId)
            ];
        }
        throw new ResourceException('图片上传失败', [$config['upload_key'] => $image->getErrorMessage()]);
    }

    // todo 同时上传多张图片
    public function wangEditorUpload(Request $request)
    {
        $errno = 0;
        $error = '';
        $data = [];
        try {
            $image = $this->upload($request);
            $data[] = $image['image_url'];
        } catch (ResourceException $e) {
            $errno = $e->getStatusCode();
            $error = $e->getErrors()->first();
        }

        return [
            'errno' => $errno,
            'data' => $data,
            'error' => $error
        ];
    }

    protected function hashName(UploadedFile $image)
    {
        $name = md5_file($image->getRealPath());
        return substr($name, 0, 2) . DIRECTORY_SEPARATOR . $name . '.' . $image->clientExtension();
    }
}
