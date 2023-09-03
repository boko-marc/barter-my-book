<?php

namespace Core\Repository\Eloquent;

use Core\Repository\Eloquent\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\Type\FalseType;

class BaseRepository implements EloquentRepositoryInterface
{
    /**      
     * @var Model      
     */
    protected $model;

    /**      
     * BaseRepository constructor.      
     *      
     * @param Model $model      
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }


    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function make(array $attributes): Model
    {
        return $this->model->make($attributes);
    }

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }
    /**
     * @param $conditions
     * @param $relations
     * @return Collection
     */
    public function findBy(array $conditions, array $relations = []): Collection
    {
        $query = $this
            ->model
            ->with($relations)
            ->where($conditions);
        return $query->get();
    }

    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    public function associate(Model $model, array $relations): Model
    {
        foreach ($relations as $key => $value) {
            $model->$key()->associate($value);
        }
        $model->save();
        return $model;
    }





    public function findOneBy(array $conditions, array $relations = []): ?Model
    {
        return $this
            ->model
            ->with($relations)
            ->where($conditions)
            ->first();
    }

    public function update(array $data, Model $model): Model|FalseType
    {
        return $model->update($data) ? $model : false;
    }
}
