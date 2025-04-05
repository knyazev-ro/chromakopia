<?php

namespace App\Services;

use App\Models\Common\Media;
use App\Packages\Common\Application\Interfaces\IMediaService;
use Illuminate\Http\UploadedFile;

class MediaService
{

    public function saveMedia(UploadedFile $media, string $module = '', string $section = '', string $folder = '', string $driver = 'local'): int
    {
        $path = $media->store('/files/media' . (empty($folder) ? '' : "/$folder"), $driver);
        $data = [
            'path' => '/'.$path,
            'original_name' => $media->getClientOriginalName(),
            'size' => $media->getSize(),
            'type' => $media->getMimeType(),
            'section' => $section,
            'module' => $module
        ];
        $rec = Media::create($data);
        return $rec->id;
    }

    public function getMedia(int $id)
    {
        $rec = Media::find($id);
        if (!$rec) return null;

        return $rec;
    }

    public function deleteMedia(int $id)
    {
        Media::destroy($id);
    }
}
