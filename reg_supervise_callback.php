<?php if (!defined('SYSTEM_ROOT')) { die('Insufficient Permissions'); } 
function callback_install() {
	option::pset("reg_supervise", array('geetest_id' => '11dc9995dc0bad48b0f09be598d36cc5','geetest_key' => '2d0448808629d1921f836d19d131e690')); 
	global $m;
	$m->query("CREATE TABLE IF NOT EXISTS `".DB_PREFIX."reg` (
  `ip` varchar(100) NOT NULL,
 UNIQUE KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
	cron::set('reg_supervise','plugins/reg_supervise/reg_supervise_cron.php',0,'清理注册ip记录等<br/>忽略或卸载此任务可能会导致无法正常注册',0);
	}
function callback_init() {
	option::add(salt,getRandStr(10));
}
function callback_inactive(){
	option::del(reg_jg);
	option::del(salt);
}
function callback_remove() {
	cron::del('reg_supervise');
	option::xdel('reg_supervise');
	global $m;
	$m->query('DROP TABLE `'.DB_NAME.'`.`'.DB_PREFIX.'reg`');
	option::del('reg_supervise_run');
	}

