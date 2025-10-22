
CREATE TABLE `admins` (
`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`nickname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '昵称',
`avatar` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '头像',
`username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
`password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
`remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '记住密码token',
`role_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '角色表id',
`role_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '角色名称',
`sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
`status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
`age` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '年龄',
`city` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '城市',
`address` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '地址',
`motto` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '座右铭',
`phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '手机号',
`sex` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '性别',
`tags` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '标签',
`login_last_ip` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '最后登录IP',
`login_last_time` timestamp NULL DEFAULT NULL COMMENT '最后登录时间',
`login_num` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
`create_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
`update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
`delete_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
PRIMARY KEY (`id`),
UNIQUE KEY `users_name_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='后台用户表';

CREATE TABLE `language` (
`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
`sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
`name` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名称',
`zh-CN` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '中文',
`en-US` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '英文',
`ja-JP` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '日文',
`zh-TW` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '繁体',
`remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '备注',
`create_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`update_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`create_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
`update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
`delete_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='语言表（国际化）';

CREATE TABLE `menu` (
`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`language_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '菜单名称,保存语言表id',
`parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
`menu_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单类型',
`menu_api` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单依赖接口',
`component` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '组件路径',
`path` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '路由地址',
`icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图标',
`permission` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '权限标识',
`sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
`status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
`redirect` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '重定向',
`target` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '窗口打开方式',
`layout` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'layout布局',
`navTheme` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单主题',
`headerTheme` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '顶部菜单主题',
`fixSiderbar` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否固定导航',
`fixedHeader` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否固定header到顶部',
`flatMenu` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '隐藏自己,并且将子节点提升到与自己平级',
`hideInMenu` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '隐藏菜单',
`hideChildrenInMenu` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '隐藏子菜单',
`hideInBreadcrumb` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '在面包屑中隐藏',
`menuRender` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '显示菜单',
`menuHeaderRender` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '显示菜单顶栏',
`headerRender` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '显示顶栏',
`footerRender` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '显示页脚',
`create_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`update_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`create_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
`update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
`delete_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
PRIMARY KEY (`id`),
UNIQUE KEY `permission_unique` (`permission`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='菜单表';

CREATE TABLE `admin_role` (
`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`role_name` varchar(255) NOT NULL COMMENT '角色名称',
`role_code` varchar(255) NOT NULL COMMENT '角色名称',
`sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
`status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
`describe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '描述',
`create_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`update_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`create_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
`update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
`delete_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='角色表';

CREATE TABLE `admin_role_menu` (
`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`role_id` int(11) unsigned NOT NULL COMMENT '角色id',
`menu_ids` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '前端权限',
`menu_all_ids` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '前端权限(包含父级id)',
`api_ids` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '接口权限',
PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='角色菜单表';

CREATE TABLE `admin_api` (
`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
`api_name` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '接口名称',
`api_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'api' COMMENT '类型(目录 dir 接口 api)',
`api_path`  varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '接口路径',
`method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '接口请求方式',
`sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
`status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
`create_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`update_by` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`create_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
`update_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
`delete_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除时间',
PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='后台接口表';









