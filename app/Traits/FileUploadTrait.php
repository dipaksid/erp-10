<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileUploadTrait
{
    /**
     * Uploads a file from a request and saves it to the specified destination directory.
     * If a file with the same name already exists, it will be deleted before moving the new file.
     *
     * @param Request $request The incoming HTTP request object containing the file.
     * @param string $fileInputName The name of the file input field in the form.
     * @param string $destinationDirectory The directory where the file should be saved.
     * @param string|null $fileName The desired file name (optional). If not provided, the original file name will be used.
     *
     * @return string|null The uploaded file's name if successful, or null if no file was uploaded.
     */
    public function uploadFile(Request $request, string $fileInputName, string $destinationDirectory, ?string $fileName = null)
    {
        if ($request->hasFile($fileInputName)) {
            $file = $request->file($fileInputName);
            $directoryPath = public_path($destinationDirectory);

            if (!File::exists($directoryPath)) {
                File::makeDirectory($directoryPath, 0777, true, true);
            }

            if (File::exists(public_path($destinationDirectory . '/' . $fileName))) {
                File::delete(public_path($destinationDirectory . '/' . $fileName));
            }
            // Move the new file to the destination directory
            $file->move(public_path($destinationDirectory), $fileName);

            return $fileName;
        }

        return null;
    }
}
