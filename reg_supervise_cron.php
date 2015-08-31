<?php if (!defined('SYSTEM_ROOT')) { die('Insufficient Permissions'); }
function cron_reg_supervise() {
	if (option::get('reg_supervise_run') == date('d')) {
        return ok;
    }
	global $m;
	$m->query("DELETE FROM  `".DB_NAME."`.`".DB_PREFIX."users` WHERE `".DB_PREFIX."users`.`role` = 'banned'");//当天清除昨天未激活用户（建议）
	$m->query("truncate table `".DB_NAME."`.`".DB_PREFIX."reg`");//清除注册ip记录（必须）	
	option::set('reg_supervise_run', date('d'));
    return '成功';
	
}

