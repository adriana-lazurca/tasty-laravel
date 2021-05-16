<?php

namespace App\Models;
//use Illuminate\Support\Facades\;

use Facade\FlareClient\Stacktrace\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File as FacadesFile;
use Symfony\Component\Finder\SplFileInfo;

class Post
{
    public static function all()
    {
        $files =  FacadesFile::files(resource_path("posts/"));
        
        $getFileContent = function (SplFileInfo $file) {
            return $file->getContents();
        };

        return array_map($getFileContent, $files);
    }

    public static function find(string $slug)
    {
        $path = resource_path("posts/{$slug}.html");

        if (!file_exists($path)) {
            throw new ModelNotFoundException("not working");
        }

        return cache()->remember("posts.{$slug}", 1200, function () use ($path) {
            return file_get_contents($path);
        });
    }
}
