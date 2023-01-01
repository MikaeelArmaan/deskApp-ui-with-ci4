<?php

namespace App\Traits;

use Config\Services;

trait FileUploadTrait
{
    public function doFileUpload($file, $path, $validationRules, $validationMessage)
    {
        $response = ['status' => false, 'errors' => [], 'data' => []];
        // Validate file input
        $validation = Services::validation();
        $validation->setRules($validationRules, $validationMessage);
        if (!$validation->run()) {
            $response['errors'] = $validation->getErrors();
            return $response;
        }
        // $fileService = Services::image();
        // Generate random filename

        $fileName = time() . '_' . $file->getName();
        // Move the file to the desired path
        if ($file->move($path, $fileName)) {
            $this->doFileResize($path, $fileName);
            $response['status'] = true;
            $response['data'] = ['file_name' => $fileName, 'path' => $path];
        } else {
            $response['errors'][] = 'Unable to upload file';
        }
        return $response;
    }

    public function doFileResize($path, $fileName, $width = 100, $height = 100)
    {
        $response = ['status' => false, 'errors' => []];
        // Load image library
        $image = Services::image();
        // Open the file
        $image->withFile($path . '/' . $fileName);
        // Resize the image
        $image->resize($width, $height);
        // Save the file
        echo '<pre>';
        print_r($image);
        exit;
        if ($image->save($path . '/thumbnails/' . $fileName)) {
            $response['status'] = true;
        } else {
            $response['errors'][] = 'Unable to resize image';
        }
        return $response;
    }
}
