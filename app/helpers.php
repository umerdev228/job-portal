<?php

use App\Models\Notification;

function getNotifications() {
    return Notification::where('receiver_id', \Illuminate\Support\Facades\Auth::id())->orderBy('id')->get()->toArray();

    // function getNotifications(){
    // $data = Notification::where("status" , "unread")->get();
    // return $data;
}
