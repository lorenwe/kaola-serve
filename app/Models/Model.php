<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    const DELETED_AT = 'delete_at';
    const UPDATED_AT = 'update_at';
    const CREATED_AT = 'create_at';

    // 时间字段格式化标准
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->where($this->table.".delete_at",0);
    }
}
