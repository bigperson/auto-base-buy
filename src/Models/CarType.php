<?php

namespace Bigperson\AutoBaseBuy\Models;

use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'car_type';

    /**
     * The primary column associated with the table
     *
     * @var string
     */
    protected $primaryKey = 'id_car_type';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carMarks()
    {
        return $this->hasMany(CarMark::class, 'id_car_type');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carModels()
    {
        return $this->hasMany(CarModel::class, 'id_car_type');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carGenerations()
    {
        return $this->hasMany(CarGeneration::class, 'id_car_type');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carSeries()
    {
        return $this->hasMany(CarSerie::class, 'id_car_type');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carModifications()
    {
        return $this->hasMany(CarModification::class, 'id_car_type');
    }
}
