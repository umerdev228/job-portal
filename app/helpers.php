<?php

use App\Models\Notification;

function getNotifications(){
    $data = Notification::all();
    return $data;

    // function getNotifications(){
    // $data = Notification::where("status" , "unread")->get();
    // return $data;
}