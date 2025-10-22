<?php

namespace App\Services;

use \Illuminate\Pagination\LengthAwarePaginator;
/**
 * 重写分页返回数组
 * Class LengthAwarePaginatorService
 * @package App\Services\Common
 */
class LengthAwarePaginatorService extends LengthAwarePaginator
{
    public function toArray()
    {
        return [
            'list' => $this->items->toArray(),       // 列表
            'total' => $this->total(),               // 总数量
            'current_page' => $this->currentPage(),  // 当前页
            'page_size' => (int)$this->perPage(),    // 每页显示
            'pages' => $this->lastPage(),            // 总页数
        ];
    }
}
