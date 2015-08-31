<?php if (!defined('SYSTEM_ROOT')) { die('Insufficient Permissions'); }
return array(
	'plugin' => array(
		'name'        => '开放注册管理',
		'version'     => '4.9',
		'description' => '用于解决开放注册所可能导致的一些问题',
		'onsale'      =>  true,
		'url'         => 'http://www.stus8.com/forum.php?mod=viewthread&tid=7682',
		'for'         => '4.0+',
        'forphp'      => 'all'
	),
	'author' => array(
		'author'      => '云幻',
		'email'       => '',
		'url'         => 'http://www.yunhuan.tk/'
	),
	'view'   => array(
		'setting'     => true,
		'show'        => false,
		'vip'         => false,
		'private'     => false,
		'public'      => true,
		'update'      => true,
	),
	'page'   => array(
	)
);