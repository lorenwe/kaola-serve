<?php
namespace App\Models;

class AdminRole extends Model
{
    protected $table = 'admin_role';

    // 允许所有字段批量赋值
    protected $guarded = [];

    public function scopeDefaultOrder($query) {
        return $query->when(
            !$query->getQuery()->orders,
            function ($query) {
                return $query->orderBy($this->table.".create_at", 'desc');
            }
        );
    }

}
