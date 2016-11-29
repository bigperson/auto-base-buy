<?php

namespace Bigperson\AutoBaseBuy\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    /**
     * The primary column associated with the table
     *
     * @var string
     */
    protected $primaryKey = 'id_car_model';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'car_model';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carMark()
    {
        return $this->belongsTo(CarMark::class, 'id_car_mark');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carGenerations()
    {
        return $this->hasMany(CarGeneration::class, 'id_car_model');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carSeries()
    {
        return $this->hasMany(CarSerie::class, 'id_car_model');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carType()
    {
        return $this->belongsTo(CarType::class, 'id_car_type');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carModifications()
    {
        return $this->hasMany(CarModification::class, 'id_car_model');
    }

    public function searchableAs()
    {
        return 'id_car_model';
    }
}
