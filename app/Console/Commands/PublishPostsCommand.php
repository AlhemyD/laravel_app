<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class PublishPostsCommand extends Command
{
    protected $signature = 'posts:publish-auto';

    protected $description = 'Автоматически публиковать посты, которые назначены на публикацию';
	
	public function handle() {
		$posts = Post::where('published',false)->where('publish_at',"<=",str_replace(' ', 'T', now()))->where('published_at','=',null)->get();
		
		foreach ($posts as $post) {			
			$post->published = true;
			$post->published_at = now();
			$post->save();
		}
	}

}
