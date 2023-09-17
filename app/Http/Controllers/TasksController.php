<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResourceModel\TaskResource;
use App\Http\Utils\filterData;
use App\Models\DataModel\Tasks;
use App\Http\Utils\ResponseBuilder;
use Exception;

class TasksController extends Controller
{
   
    public function index(Request $request)
    {
        $data = new filterData($request);
        $tasks = TaskResource::filterAndPaginate($data);
        return $tasks;
    }

    public function store(Request $request)
    {
        try{
            $tasks = new Tasks($request);
            $status = TaskResource::create($tasks);

            if($status)
                return ResponseBuilder::response(http_response_code(),"Task is successfully saved!");
            else
                return ResponseBuilder::response(http_response_code(401),"Task save failed!");

        }
        catch(Exception $e){

        }
       
    }

    public function show($id)
    {
        return TaskResource::filterById($id);
    }

    public function update(Request $request, $id)
    {
        $tasks = new Tasks($request);
        TaskResource::update($tasks, $id);
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
