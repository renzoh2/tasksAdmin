<?php

namespace App\Models\ResourceModel;

use App\Models\Task;
use App\Models\Interfaces\taskInterface;
use App\Http\Utils\filterData;
use App\Models\DataModel\Tasks;

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
        return Task::where("id", "=", $id)->get();
    }

    public static function filterAndPaginate(filterData $data)
    {
        $tasks = new Task;

        if($data->getFilter())
        {
            $tasks = $tasks->where([
                [$data->getFilter()["key"], "like", $data->getFilter()["value"].'%'],
                ['status','=','active']
            ]);
        }
       
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

        return $taskModel->save();
    }

    public static function update(Tasks $task, $id)
    {
        $taskModel = Task::where('id', $id)->update((array) $task);
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