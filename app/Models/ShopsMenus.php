<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopsMenus extends Model
{
    use HasFactory, SoftDeletes;

    // 테이블명
    protected $table = 'shops_menus';

    protected $primaryKey = 'menu_idx';

    // 대량 할당 가능한 속성
    protected $fillable = [
        'menu_name',
        'shop_idx',
        'menu_description',
        'menu_price',
        'menu_category',
        'created_at',
        'updated_at',
        'is_available',
        'menu_image_url',
    ];
}
