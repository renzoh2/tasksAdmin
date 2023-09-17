<?php
namespace App\Http\Utils;

class filterData
{
    private $filter = null;
    private $sort = null;
    private $orderBy = null;
    private $page = null;
    private $limit = null;

    function __construct($request){
        $this->filter = $request['filter'] ?: null;
        $this->sort = $request['sort'] ?: "task_title";
        $this->orderBy = $request['orderBy'] ?: "ASC";
        $this->page = $request['page'] ?: 0;
        $this->limit = $request['limit'] ?: 10;
    }

    public function getFilter()
    {
        return $this->filter;
    }

    public function getSort()
    {
        return $this->sort;
    }

    public function getOrderBy()
    {
        return $this->orderBy;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function getLimit()
    {
        return $this->limit;
    }
}

?>