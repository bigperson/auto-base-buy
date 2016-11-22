<?php

namespace Bigperson\AutoBaseBuy\Models;

use Illuminate\Database\Eloquent\Model;

class CarSerie extends Model
{
    /**
     * The primary column associated with the table
     *
     * @var string
     */
    protected $primaryKey = 'id_car_serie';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'car_serie';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car_model()
    {
        return $this->belongsTo(CarModel::class, 'id_car_model');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car_generation()
    {
        return $this->belongsTo(CarGeneration::class, 'id_car_generation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car_type()
    {
        return $this->belongsTo(CarType::class, 'id_car_type');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function car_modifications()
    {
        return $this->hasMany(CarModification::class, 'id_car_serie');
    }
}
