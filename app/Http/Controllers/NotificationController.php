<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(){
        $notifications = auth()->user()->notifications;

        return view('notifications.index', compact('notifications'));
    }

    public function show(){
        $notifications = Notification::where('user_id', auth()->user()->id)->latest()->paginate(10);
        return view('all-notification', compact('notifications'));
    }

    public function markAsRead(Notification $notification){
        $notification->update(['read' => true]);

        return redirect()->back();
    }

    public function markAllAsUnread(){
        Notification::where('user_id', auth()->user()->id)->where('read', false)->update(['read' => true]);
        return redirect()->back();
    }
}
