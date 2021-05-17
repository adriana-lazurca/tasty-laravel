<?php

namespace App\Models;

use Spatie\YamlFrontMatter\YamlFrontMatter;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File as FacadesFile;


class Post
{
    public $title;
    public $excerpt;
    public $date;
    public $body;

    public function __construct($title, $slug, $excerpt, $date, $body)
    {
        $this->title = $title;
        $this->slug = $slug;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
    }

    public static function all()
    {
        $files =  FacadesFile::files(resource_path("posts"));

        return collect($files)
            ->map(fn ($file) => YamlFrontMatter::parseFile($file))
            ->map(fn ($document) =>
            //$document = YamlFrontMatter::parseFile($file);

            new Post(
                $document->title,
                $document->slug,
                $document->excerpt,
                $document->date,
                $document->body()
            ));


        // foreach ($files as $file) {
        //     $document = YamlFrontMatter::parseFile($file);

        //     $posts[] = new Post(
        //         $document->title,
        //         $document->slug,
        //         $document->excerpt,
        //         $document->date,
        //         $document->body()
        //     );
        // }

        //ddd($posts);

    }

    public static function find(string $slug)
    {
        //of all the blog posts, find the one that matches the one that was requested
$posts = static::all();
return $posts->firstWhere('slug', $slug);


        // $path = resource_path("posts/{$slug}.html");

        // if (!file_exists($path)) {
        //     throw new ModelNotFoundException("not working");
        // }

        // return cache()->remember("posts.{$slug}", 1200, function () use ($path) {
        //     return file_get_contents($path);
        // });
    }
}
