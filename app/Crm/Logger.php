<?php

namespace App\Crm;

use App\Log;

class Logger
{
    public function save($complain_id, $content)
    {
        $log = new Log();
        $log->content = $content;
        $log->complain_id = $complain_id;
        $log->save();

        return $log;
    }
}
