<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Facades\DB;

class AdminRoleMenu extends EloquentModel
{
    public $timestamps = false;

    protected $table = 'admin_role_menu';

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    // 允许所有字段批量赋值
    protected $guarded = [];

    public function addAll(Array $data)
    {
        $rs = DB::table($this->getTable())->insert($data);
        return $rs;
    }

}
