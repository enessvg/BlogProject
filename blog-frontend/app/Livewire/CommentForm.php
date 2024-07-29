<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CommentForm extends Component
{
    private $apiUrl;
    public function __construct() {
        $this->apiUrl = config('services.api_url');
    }

    public $postId;
    public $name;
    public $email;
    public $content;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'content' => 'required|string',
    ];

    public function submit()
    {
        $this->validate();

        $response = Http::post($this->apiUrl.'api/comments', [
            'post_id' => $this->postId,
            'name' => $this->name,
            'email' => $this->email,
            'content' => $this->content,
        ]);

        if ($response->successful()) {
            session()->flash('message', 'Comment submitted successfully!');
        } else {
            session()->flash('error', 'Your comment could not be sent. Try again later!');
        }
    }

    public function render()
    {
        return view('livewire.comment-form');
    }
}
