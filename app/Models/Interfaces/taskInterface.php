<?php
namespace App\Models\Interfaces;

use App\Http\Utils\filterData;
use App\Models\DataModel\Tasks;

interface taskInterface
{
    public static function all();
    public static function filter(filterData $data);
    public static function filterById($id);
    public static function filterAndPaginate(filterData $filter);
    public static function create(Tasks $task);
    public static function update(Tasks $task, $id);
    public static function archive($id);
    public static function delete($id);
}

?>