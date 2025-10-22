<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
    // use SoftDeletes; // 开启软删除

    protected $table = 'admins';

    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';
    const DELETED_AT = 'delete_at';

//    /**
//     * 允许批量添加的字段
//     *
//     * @var array<int, string>
//     */
//    protected $fillable = [
//        'nickname',
//        'username',
//        'status',
//    ];
    // 允许所有字段批量赋值
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'create_at' => 'datetime:Y-m-d H:i:s',
        'update_at' => 'datetime:Y-m-d H:i:s',
        'password' => 'hashed',
    ];


    public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->where($this->table.".delete_at",0);
    }
}
