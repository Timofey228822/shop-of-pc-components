<?php

namespace App\Services;

use App\Models\ProductImage;
use Exception;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    protected const THUMBNAIL_WIDTH = 550;
    protected const THUMBNAIL_HEIGHT = 250;

    function createThumbnailAndImage($img, $product): void
    {
        $width = self::THUMBNAIL_WIDTH;
        $height = self::THUMBNAIL_HEIGHT;

        $path = $img->store('products', 'public');

        $thumbnailPath = 'thumbs/' . pathinfo($path, PATHINFO_BASENAME);
        $imageInfo = getimagesize($img->getRealPath());

        switch ($imageInfo['mime']) {
            case 'image/jpeg':
                $sourceImage = imagecreatefromjpeg($img->getRealPath());
                break;
            case 'image/png':
                $sourceImage = imagecreatefrompng($img->getRealPath());
                break;
            case 'image/webp':
                $sourceImage = imagecreatefromwebp($img->getRealPath());
                break;
            default:
                throw new Exception('Такие картинки создавать нельзя');
        }

        $originalWidth = imagesx($sourceImage);
        $originalHeight = imagesy($sourceImage);

        $ratio = min($width / $originalWidth, $height / $originalHeight);

        $newWidth = (int)($originalWidth * $ratio);
        $newHeight = (int)($originalHeight * $ratio);

        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

        imagecopyresampled(
            $resizedImage,
            $sourceImage,
            0,
            0,
            0,
            0,
            $newWidth,
            $newHeight,
            $originalWidth,
            $originalHeight
        );

        Storage::disk('public')->path($thumbnailPath);

        imagedestroy($sourceImage);
        imagedestroy($resizedImage);

        ProductImage::create([
            'product_id' => $product->id,
            'type' => 'thumbnail',
            'path' => $thumbnailPath,
        ]);

        ProductImage::create([
            'product_id' => $product->id,
            'type' => 'main',
            'path' => $path,
        ]);
    }

    function updateBothImages($img, $product)
    {

        ProductImage::where('product_id', $product->id)->delete();

        $width = self::THUMBNAIL_WIDTH;
        $height = self::THUMBNAIL_HEIGHT;

        $path = $img->store('products', 'public');
        $thumbnailPath = 'thumbs/' . pathinfo($path, PATHINFO_BASENAME);

        $imageInfo = getimagesize($img->getRealPath());

        switch ($imageInfo['mime']) {
            case 'image/jpeg':
                $sourceImage = imagecreatefromjpeg($img->getRealPath());
                break;
            case 'image/png':
                $sourceImage = imagecreatefrompng($img->getRealPath());
                break;
            case 'image/webp':
                $sourceImage = imagecreatefromwebp($img->getRealPath());
                break;
            default:
                throw new Exception('Такие картинки создавать нельзя');
        }

        $originalWidth = imagesx($sourceImage);
        $originalHeight = imagesy($sourceImage);

        $ratio = min($width / $originalWidth, $height / $originalHeight);

        $newWidth = (int)($originalWidth * $ratio);
        $newHeight = (int)($originalHeight * $ratio);

        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

        imagecopyresampled(
            $resizedImage,
            $sourceImage,
            0,
            0,
            0,
            0,
            $newWidth,
            $newHeight,
            $originalWidth,
            $originalHeight
        );

        imagedestroy($sourceImage);
        imagedestroy($resizedImage);

        ProductImage::create([
            'product_id' => $product->id,
            'type' => 'thumbnail',
            'path' => $thumbnailPath,
        ]);

        ProductImage::create([
            'product_id' => $product->id,
            'type' => 'main',
            'path' => $path,
        ]);

        $fullPath = Storage::disk('public')->path($thumbnailPath);

        match ($img->getMimeType()) {
            'image/jpeg' => imagejpeg($resizedImage, $fullPath, 85),
            'image/png' => imagepng($resizedImage, $fullPath, 6),
            'image/webp' => imagewebp($resizedImage, $fullPath, 6)
        };
    }
}
