<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

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
        $files = File::files(resource_path("posts/"));

        return array_map(function ($file) {

            return $file->getContents();
        }, $files);
    }

    public static function find($slug)
    {
        $path = resource_path("posts/{$slug}.html"); //$post

        if (!file_exists($path)) {
            throw new ModelNotFoundException(); // If not found throw exception messager to user 
        };
        return cache()->remember("posts.{$slug}", 5, function () use ($path) {
            return file_get_contents($path);   //var_dump('file_get_contents');
        });
    }
}
