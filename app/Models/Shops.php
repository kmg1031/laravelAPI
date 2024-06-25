<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shops extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'address', 'is_all_day', 'opened_at', 'closed_at'];

    protected $primaryKey = 'idx';


    /*
     * relationship
     */
    public function menus()
    {
        return $this->hasMany(ShopsMenus::class, 'shop_idx', 'idx');
    }
}
