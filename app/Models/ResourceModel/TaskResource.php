<?php

namespace App\Models\ResourceModel;

use App\Models\Task;
use App\Models\Interfaces\taskInterface;
use App\Http\Utils\filterData;
use App\Models\DataModel\Tasks;
use Exception;

class TaskResource implements taskInterface
{
    public static function all()
    {
        return Task::all();
    }

    public static function filter(filterData $data)
    {
        return Task::where([[$data->getFilter()["key"], "=", $data->getFilter()["value"]]])->get();
    }

    public static function filterById($id)
    {
        return Task::where("id", "=", $id)->first();
    }

    public static function filterAndPaginate(filterData $data)
    {
        $tasks = new Task;

        if(!empty($data->getFilter()))
        {
            $tasks = $tasks->where($data->getFilter()["key"], "REGEXP", $data->getFilter()["value"]);
        }

        //Default Where
        $tasks = $tasks->where((function($q) {
            $q->where('status', '=', 'todo')
              ->orWhere('status', '=', 'inprogress')
              ->orWhere('status', '=', 'completed');
        }));

        $tasks = $tasks->orderBy($data->getSort(), $data->getOrderBy());

        //page skip computation
        $skip = $data->getPage() * 10;
        $tasks = $tasks->skip($skip)->take($data->getLimit());
        return $tasks->get();
    }

    public static function create(Tasks $task)
    {
        
        $taskModel = new Task();
        $taskModel->task_title = $task->task_title;
        $taskModel->task_description = $task->task_description;
        $taskModel->user_id = $task->user_id;
       try {
        return $taskModel->save();
       }
       catch( Exception $e)
       {
        return false;
       }
    }

    public static function update(Tasks $task, $id)
    {
        try{
            Task::where('id', $id)->update((array) $task);
            return Task::where("id", $id)->first();
        }
        catch( Exception $e)
       {
        return $e->getMessage();
       }
        
    }

    public static function archive($id)
    {
        Task::where('id', $id)->update(["status"=>"archived"]);
    }
    public static function delete($id)
    {
        Task::where('id', $id)->update(["status"=>"deleted"]);
    }
}
?>