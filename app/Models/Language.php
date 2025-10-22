<?php
namespace App\Models;

class Language extends Model
{
    protected $table = 'language';

    // 允许所有字段批量赋值
    protected $guarded = [];


    /*public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->orderBy($this->table.".create_at", 'desc');
    }*/

    public function scopeDefaultOrder($query) {
        return $query->when(
            !$query->getQuery()->orders,
            function ($query) {
                return $query->orderBy($this->table.".create_at", 'desc');
            }
        );
    }

}
