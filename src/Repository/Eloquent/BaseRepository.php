<?php

namespace Core\Repository\Eloquent;

use Core\Repository\Eloquent\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
}
