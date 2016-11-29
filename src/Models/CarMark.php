<?php

namespace Bigperson\AutoBaseBuy\Models;

use Illuminate\Database\Eloquent\Model;

class CarMark extends Model
{
    /**
     * The primary column associated with the table
     *
     * @var string
     */
    protected $primaryKey = 'id_car_mark';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'car_mark';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carType()
    {
        return $this->belongsTo(CarMark::class, 'id_car_type');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carModels()
    {
        return $this->hasMany(CarModel::class, 'id_car_mark');
    }
}
