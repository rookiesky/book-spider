<?php
namespace Spider\Repositories;

use Illuminate\Database\Capsule\Manager as Capsule;

class Repository
{
    public $model = null;

    public function first($where = [],$order = 'id', $sort = 'desc')
    {
        $query = $this->model;
        if(count($where) >= 1){
            foreach ($where as $key=>$value){
                $query = $query->where($key,$value);
            }
        }
        return $query->orderBy($order,$sort)->first();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function addAll($data)
    {
        return Capsule::table($this->model->getTable())->insert($data);

    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }
}