<?php

namespace Core\Repository\Eloquent;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\Type\FalseType;

/**
 * Interface EloquentRepositoryInterface
 */
interface EloquentRepositoryInterface
{
   /**
    * @param array $attributes
    * @return Model
    */
   public function create(array $attributes): Model;


   /**
    * @param array $attributes
    * @return Model
    */
   public function make(array $attributes): Model;

   /**
    * Find one model instance
    * @param $conditions
    *@param $relations
    * @return Model
    */
   public function findOneBy(array $conditions, array $relations = []): ?Model;

   public function findBy(array $conditions, array $relations = []): Collection;

   /**
    * Get all models.
    *
    * @param array $columns
    * @param array $relations
    * @return Collection
    */
   public function all(array $columns = ['*'], array $relations = []): Collection;

   /**
    * Associate  models.
    *
    * @param array $relations
    * @param Model $model
    * @return Model
    */
   public function associate(Model $model, array $relations): Model;


   /**
    * Update  row.
    *
    * @param array $data
    * @param Model $model
    * @return Model
    */
   public function update(array $data, Model $model): Model|FalseType;
}
