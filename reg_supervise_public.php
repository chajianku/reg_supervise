<?php if (!defined('SYSTEM_ROOT')) { die('Insufficient Permissions'); }loadhead();?>
<?php if (isset($_GET['error_msg'])): ?>
<div class="alert alert-danger alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<?php echo strip_tags($_GET['error_msg']); ?></div><?php endif;?>
<div style="display:none;"><script src="http://js.users.51.la/17795549.js"></script></div> 
<?php if (isset($_GET['success_msg'])): ?>
<div class="alert alert-success alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<?php echo strip_tags($_GET['success_msg']); ?></div><?php endif;?>
<?php
if(isset($_GET['jh'])){
global $m;
$email = base64_decode($_GET['email']);
$key = $_GET['key'];
$cx = $m->query("SELECT * FROM  `".DB_NAME."`.`".DB_PREFIX."users` WHERE email = '{$email}' LIMIT 1");
$p = $m->fetch_array($cx);
$pw=sha1(md5($p['pw'] . date('Ymd') . option::get(salt)));
if($pw!=$key){
	ReDirect(SYSTEM_URL.'index.php?pub_plugin=reg_supervise&error_msg=链接无效！！');
	die;
	}else{	
	$m->query("UPDATE `".DB_NAME."`.`".DB_PREFIX."users` SET `role` = 'user' WHERE email = '{$email}'");
	setcookie("wmzz_tc_user",$p['name']);
	setcookie("wmzz_tc_pw",$p['pw']);
	ReDirect(SYSTEM_URL.'index.php?pub_plugin=reg_supervise&success_msg=用户激活成功！请绑定百度账号。');
	}
}
?>