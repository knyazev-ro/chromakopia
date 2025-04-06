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
            'path' => '/' . $path,
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

    /**
     * handleFileUploads
     * Method for saving or deleting attached files.
     *
     * @param  array $files
     * @return array
     */
    public  function handleFileUploads(array $files, string $module, string $folder): array
    {
        return collect($files)
            ->map(function ($file) use($module, $folder) {
                if ($file instanceof UploadedFile) {
                    // Сохраняем новый файл
                    return $this->saveMedia($file, $module, '', $folder);
                }

                if (is_array($file) && isset($file['id'])) {
                    // Если указано, что файл удаляется — удалим
                    if (!empty($file['deleted'])) {
                        $this->deleteMedia($file['id']);
                        return null; // Удалённый файл не добавляется в массив
                    }

                    // Просто указываем ID уже прикреплённого файла
                    return (int) $file['id'];
                }

                // Неизвестный формат файла
                throw new \InvalidArgumentException('Unknown file type.');
            })
            ->filter() // Убираем null (удалённые файлы)
            ->values() // Переиндексация массива
            ->toArray();
    }
}
