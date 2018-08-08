<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * OneSignal
 *
 * @package App\Http\Models
 */
class AppPush extends Model
{
    protected $table = 'app_push';
    protected $primaryKey = 'p_id';
    protected $fillable = ['p_content','p_back','p_nums','p_o_id'];
}