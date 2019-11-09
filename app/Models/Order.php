<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Order
 * @package App\Models
 * @version November 8, 2019, 6:30 pm UTC
 *
 * @property integer customer_id
 * @property string total
 * @property string creation_date
 */
class Order extends Model
{
    use SoftDeletes;

    public $table = 'order';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'customer_id',
        'creation_date',
        'delivery_address',
        'total',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'order_id' => 'integer',
        'customer_id' => 'integer',
        'total' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'customer_id' => 'required',
        'total' => 'required',
        'creation_date' => 'required',
        'delivery_address' => 'required',
    ];

    
}
