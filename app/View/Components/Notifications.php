<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Notifications extends Component
{
    public $notifications;

    public function __construct()
    {
        $this->notifications = auth()->user()->notifications()->where('read', false)->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.notifications');
    }
}
