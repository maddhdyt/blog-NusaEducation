<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewPostMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function build(): self
    {
        return $this
            ->subject('Artikel baru: ' . $this->post->title)
            ->view('emails.new_post');
    }
}
