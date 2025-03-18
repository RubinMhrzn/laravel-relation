<?php
namespace App\Traits;

use Illuminate\Support\Str;
trait MediaTrait
{
    public function storeMedia($file)
    {
        $media = [];
        $media['name'] = $file->getClientOriginalName();
        $media['mimetype'] = $file->getClientMimeType();
        $media['extension'] = $file->getClientOriginalExtension();

        // Generate a random file name
        $fileName = Str::random(20) . '.' . $media['extension'];

        // Store the file
        $path = $file->storeAs('public/media', $fileName);

        $media['path'] = $path;

        return $media;
    }
}
