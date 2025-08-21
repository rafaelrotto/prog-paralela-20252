<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('user.csv', function() {
    return true;
});