<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $table = 'order_details';
    protected $guarded = ['id']; //Tat ca tru id
    protected $timestamp = true;
}
