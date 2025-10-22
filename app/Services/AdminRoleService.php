<?php
namespace App\Services;

use App\Models\AdminApi;
use App\Models\AdminRole;
use App\Models\AdminRoleMenu;
use Lauthz\Facades\Enforcer;

class  AdminRoleService extends BaseService
{
    public function getIdentifier($id)
    {
        return "roles_".$id;
    }

    // 获取角色对象
    public function getRoleInfoById($id)
    {
        return AdminRole::find($id);
    }

    /**
     * 获取用户角色
     * @param $role_id
     * @return mixed
     */
    public function getRoles($role_id){
        $roles = AdminRole::query()->where('id', $role_id)->get(['id','role_name'])->toArray();
        return $roles;
    }

    /**
     * 获取角色菜单关联表信息
     * @param $role_id
     * @return mixed
     */
    public function getRoleMenu($role_id){
        $field = ['admin_role.id', 'admin_role.role_name', 'admin_role_menu.menu_ids', 'admin_role_menu.menu_all_ids', 'admin_role_menu.api_ids'];
        $role = AdminRole::select($field)
            ->leftJoin('admin_role_menu', 'admin_role_menu.role_id', '=', 'admin_role.id')
            ->where('admin_role.id', $role_id)->first()->toArray();
        return $role;
    }

    /**
     * 根据角色id获取权限 多角色合并返回权限并集
     * @param $roles_ids
     * @return array
     */
    public function getApiByRoleId($roles_ids) :array
    {
        $roles = AdminRoleMenu::query()->whereIn('roles_id', $roles_ids)->get();
        if (empty($roles)) {
            return [];
        }
        $api_ids = [];
        foreach ($roles as $role) {
            array_push($api_ids, ...array_map('intval', explode(',', $role['api_ids'])));
        }
        $api_ids = array_unique($api_ids);
        return AdminApi::query()
            ->whereIn('id',$api_ids)
            ->where('status',1)
            ->get()->toArray();
    }

    /**
     * 根据角色id获取权限列表
     * @param $roles_ids
     * @return array
     */
    public function getPerByRoleId($roles_ids) :array
    {
        $roles = AdminRoleMenu::query()->whereIn('roles_id', $roles_ids)->get()->toArray();
        if (empty($roles)) {
            return [];
        }
        foreach ($roles as $k => $role) {
            $ids = array_map('intval', explode(',', $role['api_ids']));
            $roles[$k]['api_ids'] = $ids;
        }
        return $roles;
    }

    /**
     * 设置用户权限
     * @param $api_list
     * @param $id
     */
    public function setPermissions($api_list, $id)
    {
        $id = $this->getIdentifier($id);
        Enforcer::deletePermissionsForUser($id);
        foreach ($api_list as $value) {
            Enforcer::addPermissionForUser($id, $value['api_path'], $value['method']);
        }
    }

    /**
     * 删除所属角色的权限
     * @param $id
     */
    public function delPermissions($id)
    {
        $id = $this->getIdentifier($id);
        Enforcer::deletePermissionsForUser($id);
    }
}
