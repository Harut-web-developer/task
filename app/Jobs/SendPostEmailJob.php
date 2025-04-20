<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\Subscribtion;
use App\Models\User;
use App\Mail\PostPublishedmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPostEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $post;
    /**
     * Create a new job instance.
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $post = $this->post;
        $subscribers = Subscribtion::where(['website_id' => $post->website_id])
            ->pluck('user_id')
            ->toArray();
        $users = User::whereIn('id', $subscribers);
        foreach ($users as $user) {
            $sent = $user->sent_posts()->where(['post_id' => $post->id])->exists();
            if (!$sent) {
                Mail::to($user->email)->send(new PostPublishedmail($post));
                $user->sent_posts()->attach($post->id);
            }
        }
    }
}
