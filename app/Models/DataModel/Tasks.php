<?php

namespace App\Models\DataModel;

use Illuminate\Http\Request;

class Tasks {

    public $task_title = null;
    public $task_description = null;
    public $maintask_id = null;

    public $status = null;

    public $user_id = null;

    function __construct(Request $request)
    {
        $this->task_title = $request['title'];
        $this->task_description = $request['description'];
        $this->user_id = $request['user'];
        $this->maintask_id = $request['task'];
        $this->status = $request['status'];
    }

}

?>