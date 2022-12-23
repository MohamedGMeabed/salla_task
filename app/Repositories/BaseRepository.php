<?php
namespace App\Repositories;

use App\Interfaces\BaseInterface;
use App\Models\Language;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseInterface
{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model =$model;
    }

    public function all(array $columns=['*'],array $relations=[],array $where=[],array $filter=[])
    {
        return $this->model->where($where)->with($relations)->get($columns);
    }

    public function find(int $id,array $columns=['*'],array $relations=[],array $appends=[])
    {
        return $this->model->select($columns)->with($relations)->findOrFail($id)?->append($appends) ;
    }

    public function store(array $data)
    {
        $model = $this->model->create( $data );
        return $model->fresh();
    }

    public function update(int $id ,array $data)
    {
        $model = $this->find($id);
        $model->update( $data );
        return $model;
    }

    public function delete(int $id)
    {
        return $this->find($id)->delete();
    }

    public function query(array $where=[])
    {
        return $this->model->where($where);
    }
    
}
