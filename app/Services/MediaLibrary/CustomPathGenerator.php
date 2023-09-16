<?php

namespace App\Services\MediaLibrary;

use Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
    /**
     * @param Media $media
     * 
     * @return string
     */
    public function getPath(Media $media): string
    {
        return md5($media->id).'/';
    }

    /**
     * @param Media $media
     * 
     * @return string
     */
    public function getPathForConversions(Media $media): string
    {
        return md5($media->id).'/conversions/';
    }

    /**
     * @param Media $media
     * 
     * @return string
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return md5($media->id).'/images/';
    }
}