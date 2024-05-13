<?php

use App\Models\Notification;

function getNotifications(){
    $data = Notification::all(); // Retrieve all notifications
    return $data;

    // function getNotifications(){
//     $data = Notification::where("status" , "unread")->get();
//     return $data;
}