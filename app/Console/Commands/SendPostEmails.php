<?php

namespace App\Console\Commands;

use App\Jobs\SendPostEmailJob;
use App\Models\Post;
use Illuminate\Console\Command;

class SendPostEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:post-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send new posts to website subscribers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::where(['is_sent' => false])->get();
        foreach ($posts as $post) {
            $this->info('Dispatching job for post ' . $post->title);
            dispatch(new SendPostEmailJob($post));
            $post->update(['is_sent' => true]);
        }
        $this->info('All posts dispatched');
    }
}
