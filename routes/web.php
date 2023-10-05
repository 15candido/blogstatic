<?php

use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\New_;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Symfony\Component\Yaml\Yaml;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    $files = File::files(resource_path("posts"));
    $posts = [];

    foreach ($files as $file) {
        $document =  YamlFrontMatter::parseFile($file);

        $posts[] = new Post(
            $document->title,
            $document->slug,
            $document->excerpt,
            $document->date,
            $document->body()
        );
    }

    // ddd($posts[1]->body);
    return view('posts', [
        "posts" => $posts
    ]);
});

Route::get('posts/{post}', function ($slug) {

    //Find a post by it's slug and pass it to view called "post"
    $post = Post::find($slug);
    return view("post", [
        "post" => $post
    ]);
})->where('post', '[A-z_\-]+');
