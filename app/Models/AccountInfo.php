<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'account_info';
    protected $fillable = ['account', 'name', 'gender', 'birthday', 'email', 'note'];
    protected $dates = ['deleted_at'];

    protected $guarded = ['account', 'email'];
    public $timestamps = true;

    /**
     * 16. 資料處理 帳號：字母全部轉小寫
     *
     * @param string $value
     * @return void
     */
    public function setAccountAttribute($value)
    {
        $this->attributes['account'] = strtolower($value);
    }




}