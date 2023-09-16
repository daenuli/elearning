<?php

namespace App\Invokable;

use Illuminate\Support\Facades\DB;

class ClearNotificationsTable {
    public function __invoke($param) {
        DB::table('notifications')->delete();
    }
}