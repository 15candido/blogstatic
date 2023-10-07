<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Symfony\Component\Translation\Dumper\YamlFileDumper;

class Post //extends Model
{
    use HasFactory;


    public $title, $slug, $excerpt, $date, $body;

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

        return cache()->rememberForever('posts.all', function () {
            $files = File::files(resource_path("posts"));
            return collect($files)
                ->map(function ($file) {
                    return YamlFrontMatter::parseFile($file);
                })
                ->map(function ($document) {
                    return new Post(
                        $document->title,
                        $document->slug,
                        $document->excerpt,
                        $document->date,
                        $document->body()
                    );
                });
        })
            ->sortByDesc('date');


        // // Find all files on Posts directory
        // $files = File::files(resource_path("posts"));
        // //  And collect them in to collection 
        // return collect($files)
        //     // Map over on each item and reach one, parse that file into document
        //     ->map(function ($file) {
        //         return YamlFrontMatter::parseFile($file);
        //     })
        //     // Once have a collection of documents, map over into second time and build the post
        //     ->map(function ($document) {
        //         return new Post(
        //             $document->title,
        //             $document->slug,
        //             $document->excerpt,
        //             $document->date,
        //             $document->body()
        //         );
        //     })
        //     ->sortByDesc('date');

        // Use of map arry of objects
        // $posts = array_map(function ($file) {

        //     $document = YamlFrontMatter::parseFile($file);
        //     return new Post(
        //         $document->title,
        //         $document->slug,
        //         $document->excerpt,
        //         $document->date,
        //         $document->body()
        //     );
        // }, $files);

        // New array 
        // $posts = [];
        // foreach ($files as $file) {
        //     $document =  YamlFrontMatter::parseFile($file);

        //     $posts[] = new Post(
        //         $document->title,
        //         $document->slug,
        //         $document->excerpt,
        //         $document->date,
        //         $document->body()
        //     );
        // }
    }

    public static function find($slug)
    {

        // Of all the blog post, find the one with a slug match the one that was requested

        $posts = static::all();
        return $posts->firstWhere('slug', $slug);

        // $path = resource_path("posts/{$slug}.html"); //$post
        // if (!file_exists($path)) {
        //     throw new ModelNotFoundException(); // If not found throw exception messager to user 
        // };
        // return cache()->remember("posts.{$slug}", 5, function () use ($path) {
        //     return file_get_contents($path);   //var_dump('file_get_contents');
        // });
    }
}
