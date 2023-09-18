<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResourceModel\TaskResource;
use App\Models\ResourceModel\UserResource;
use App\Http\Utils\filterData;
use App\Models\DataModel\Tasks;
use App\Http\Utils\ResponseBuilder;
use Illuminate\Support\Facades\Auth;
use Exception;

class TasksController extends Controller
{
   
    public function index(Request $request)
    {
        $data = new filterData($request);
        $tasks = TaskResource::filterAndPaginate($data);
        
        $user = UserResource::findById(Auth::id());
        $response = [];
        foreach ($tasks as $task) {
            $temp['id'] = $task['id'];
            $temp['title'] = $task['task_title'];
            $temp['description'] = $task['task_description'];
            $temp['status'] = $task['status'];
            $temp['user'] = $user['name'];
            $response[] = $temp;
          }
          
        return $response;
    }

    public function store(Request $request)
    {
        try{
            $request['user'] = Auth::id(); //Add User to Request

            $tasks = new Tasks($request);
            $status = TaskResource::create($tasks);
            if($status)
                return ResponseBuilder::response(http_response_code(),"Success","Task Created!", "Task is successfully saved!");
            else
            {
                return ResponseBuilder::response(http_response_code(), "Fail","Task Failed!","Task has failed to add!");
            }
                

        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        return TaskResource::filterById($id);
    }

    public function update(Request $request, $id)
    {
        $request["user"] = Auth::id();
        $tasks = new Tasks($request);
        $data = TaskResource::update($tasks, $id);
        if($data)
        {
            $user = UserResource::findById(Auth::id());
            $response = [];
                $response['id'] = $data['id'];
                $response['title'] = $data['task_title'];
                $response['description'] = $data['task_description'];
                $response['status'] = $data['status'];
                $response['user'] = $user['name'];
            
            return ResponseBuilder::response(http_response_code(),"Success","Task Updated!", "Task is successfully updated!", $response);
        }
        else
        {
            return ResponseBuilder::response(http_response_code(), "Fail","Task Failed!","Task has failed to update!");
        }
    }

    public function archive($id)
    {
        TaskResource::archive($id);
    }

    public function destroy($id)
    {
        TaskResource::delete($id);
    }
}
