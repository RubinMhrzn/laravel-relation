<?php

namespace App\Traits;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait MediaTrait
{
    /**
     * Upload and store a file
     *
     * @param UploadedFile $file
     * @param string $directory
     * @return string|false
     */
    public function uploadFile(UploadedFile $file, $referenceId = null,  string $directory = 'uploads'): string|false
    {
        // Generate unique filename
        $filename = time() . '_' . md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();

        // Store the file in the given directory
        $directory = $file->storeAs($directory, $filename, 'public');
        $path     = 'storage/' . $directory;

        $mediaUploadData = [
            'name' => $filename,
            // 'person_id' => $referenceId,
            'path'      => $path,
            'mimetype'      => $file->getClientMimeType(),
            // 'size'      => $file->getSize(),
            'extension' => $file->getClientOriginalExtension()
        ];

        $media = $this->appendToMediaUpload($mediaUploadData);

        return $media->path;
        // return $path ? $path : false;
    }

    /**
     * Delete a stored file
     *
     * @param string $path
     * @return bool
     */
    public function deleteFile(string $path): bool
    {
        return Storage::disk('public')->exists($path) ? Storage::disk('public')->delete($path) : false;
    }

    public function appendToMediaUpload($data)
    {
        return Media::create($data);
    }
}
