<?php

namespace Bigperson\AutoBaseBuy\Models;

use Illuminate\Database\Eloquent\Model;

class CarModification extends Model
{
    /**
     * The primary column associated with the table
     *
     * @var string
     */
    protected $primaryKey = 'id_car_modification';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'car_modification';

    public function car_serie()
    {
        return $this->belongsTo(CarSerie::class, 'id_car_serie');
    }

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
    public function car_type()
    {
        return $this->belongsTo(CarType::class, 'id_car_type');
    }
}
