<?php if (!defined('SYSTEM_ROOT')) { die('Insufficient Permissions'); } 
/*
Plugin Name: 开放注册管理
Version: 4.8
Plugin URL: 
Description: 用于解决开放注册所可能导致的一些问题
Author: 云幻
Author Email: 
Author URL: http://www.yunhuan.tk/
For: V3.9+
*/
function reg_supervise_reg(){
global $m;
$ip = $_SERVER['REMOTE_ADDR'];
$cx = $m->fetch_array($m->query('SELECT * FROM `'.DB_NAME.'`.`'.DB_PREFIX.'reg` where `ip` = "'.$ip.'"'));
if(empty($cx['ip']) && empty($_COOKIE['reg_check']) ){ ?>
	<style type="text/css">.box{width:300px;margin:20px auto;}.input-group .form-control {position: static;}</style>  
	<b>请输入您的用户信息以注册本站</b><br/><br/>
  <?php if (isset($_GET['error_msg'])): ?><div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  错误：<?php echo strip_tags($_GET['error_msg']); ?></div><?php endif;?>
  <form name="f" method="post" action="index.php?mod=admin:reg">
	<div class="input-group">
  <span class="input-group-addon">用户</span>
  <input type="text" class="form-control" name="user" required>
</div><br/>
<div class="input-group">
  <span class="input-group-addon">密码</span>
  <input type="password" class="form-control" name="pw" id="pw" required>
</div><br/>
<div class="input-group">
  <span class="input-group-addon">邮箱</span>
  <input type="email" class="form-control" name="mail" id="mail" placeholder="本站已启用邮箱验证" required >
</div>
<?php 
$yr_reg = option::get('yr_reg');
if (!empty($yr_reg)) { ?>
<br/>
<div class="input-group">
  <span class="input-group-addon">邀请码</span>
  <input type="text" class="form-control" name="yr" id="yr" required>
</div>
<?php } ?>
<div class="box">
<?php
require_once("reg_supervise_jy.php");
$geetest = new Geetest();
$geetest->set_captchaid(option::xget("reg_supervise","geetest_id"));
if ($geetest->register()) {
echo $geetest->get_widget(option::xget("reg_supervise","ys"),'zc_button');
} else {?>
</div>
<script type="text/javascript">
$(function(){
	$("#reg_supervise_gg").click(function(){
		$(this).attr("src",'plugins/reg_supervise/reg_supervise_gg.php?' + Math.random());
	});
});
</script>
<div class="input-group">
<span class="input-group-addon">验证码</span>
<input type="text" class="form-control" name="bf" placeholder="请输入图中的大写字母" required>
<span class="input-group-btn"><img src="plugins/reg_supervise/reg_supervise_gg.php" id="reg_supervise_gg" title="看不清，点击换一张"></span>
</div><div class="box">
<?php
}
?>
</div>
<div class="login-button">
<button id='zc_button'type="submit" class="btn btn-primary" style="width:100%;float:left;">继续注册</button>
</div>
	<?php
	echo '<br/>'.option::get('footer');
    doAction('footer');
    ?>
	<div style="display:none;"><script src="http://js.users.51.la/17795549.js"></script></div> 
	<div style=" clear:both;"></div>
	<div class="login-ext"></div>
	<div class="login-bottom"></div>
</div>
<?php
} else{
	echo "你24小时内已注册过了。";
}die;}
function reg_supervise_regcheck() {
require_once('reg_supervise_jy.php');
$geetest = new Geetest();
$geetest->set_privatekey(option::xget("reg_supervise","geetest_key"));
session_start();
if (isset($_POST['geetest_challenge']) && isset($_POST['geetest_validate']) && isset($_POST['geetest_seccode'])) {
$result = $geetest->validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode']);
	if ($result !== TRUE) {
	msg('注册失败：验证错误');
	}} 
elseif (strtolower($_POST['bf'])!==$_SESSION["reg_supervise_gg"]){
msg('注册失败：验证错误');
}}
function reg_supervise_login() {
	?>
	<style type="text/css">.box{width:300px;margin:10px auto;}.input-group .form-control {position: static;}</style>  
	<b>您需要输入用户和密码才能登陆 <?php echo SYSTEM_NAME ?>，请输入您的用户信息</b><br/><br/>
  <?php if (isset($_GET['error_msg'])): ?><div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  错误：<?php echo strip_tags($_GET['error_msg']); ?></div><?php endif;?>
  <form name="f" method="post" action="index.php?mod=admin:login">
	<div class="input-group">
  <span class="input-group-addon">用户</span>
  <input type="text" class="form-control" name="user" placeholder="可为用户名或者邮箱地址，不同于百度通行证，仅用于登陆本站" required>
</div><br/>
<div class="input-group">
  <span class="input-group-addon">密码</span>
  <input type="password" class="form-control" name="pw" id="pw" required>
</div>
<div class="box">
<?php
require_once("reg_supervise_jy.php");
$geetest = new Geetest();
$geetest->set_captchaid(option::xget("reg_supervise","geetest_id"));
if ($geetest->register()) {
echo $geetest->get_widget(option::xget("reg_supervise","ys"),'zc_button');
} else {?>
</div>
<script type="text/javascript">
$(function(){
	$("#reg_supervise_gg").click(function(){
		$(this).attr("src",'plugins/reg_supervise/reg_supervise_gg.php?' + Math.random());
	});
});
</script>
<div class="input-group">
<span class="input-group-addon">验证码</span>
<input type="text" class="form-control" name="bf" placeholder="请输入图中的大写字母" required>
<span class="input-group-btn"><img src="plugins/reg_supervise/reg_supervise_gg.php" id="reg_supervise_gg" title="看不清，点击换一张"></span>
</div><div class="box">
<?php
}
?>
</div>
<div class="login-button">
<button type="submit" class="btn btn-primary" style="width:100%;float:left;">登陆</button>
<input type="checkbox" name="ispersis" id="ispersis" value="1" />&nbsp;<label for="ispersis">记住我</label><br/><br/>
</div>
	<?php 
	echo '<br/>'.option::get('footer');
    doAction('footer');
  ?>
  <div style=" clear:both;"></div>
	<div class="login-ext"></div>
	<div class="login-bottom"></div>
</div>
<?php
die;}
?>
<?php
function reg_supervise_logincheck() {
require_once('reg_supervise_jy.php');
$geetest = new Geetest();
$geetest->set_privatekey(option::xget("reg_supervise","geetest_key"));
session_start();
if (isset($_POST['geetest_challenge']) && isset($_POST['geetest_validate']) && isset($_POST['geetest_seccode'])) {
$result = $geetest->validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode']);
	if ($result !== TRUE) {
	msg('登录失败：验证错误');
	}} 
elseif (strtolower($_POST['bf'])!==$_SESSION["reg_supervise_gg"]){
msg('登录失败：验证错误');
}}
function reg_supervise_yx() {
global $m;
$name = isset($_POST['user']) ? addslashes(strip_tags($_POST['user'])) : '';
$mail = isset($_POST['mail']) ? addslashes(($_POST['mail'])) : '';
$pw = isset($_POST['pw']) ? addslashes(strip_tags($_POST['pw'])) : '';
$role = 'banned';
$m->query('INSERT INTO `'.DB_NAME.'`.`'.DB_PREFIX.'users` (`id`, `name`, `pw`, `email`, `role`, `t`) VALUES (NULL, \''.$name.'\', \''.EncodePwd($pw).'\', \''.$mail.'\', \''.$role.'\', \''.getfreetable().'\');');
$ip = $_SERVER['REMOTE_ADDR'];
setcookie("reg_check",date('d'), time() + 86400);
$m->query('INSERT INTO `'.DB_NAME.'`.`'.DB_PREFIX.'reg` (`ip`) VALUES (\''.$ip.'\');');
$key=sha1(md5(EncodePwd($pw) . date('Ymd') . option::get(salt)));
$title=strip_tags(SYSTEM_NAME) . " - 注册验证";
$text="你在".SYSTEM_URL."   使用IP:".$ip."  用此邮箱注册了账号，账号：".$name."，密码".$pw."<br>点击以下链接完成安全验证，即可正常使用本站服务。如果显示禁止访问，使用浏览器隐身模式再打开链接即可<br><p>本邮件为系统自动发送，请勿回复。如果你没有进行此操作，可能是有人冒用了此邮箱，请不要点击链接</p><br>验证链接(当日有效)：".SYSTEM_URL."index.php?pub_plugin=reg_supervise".'&jh'.'&email='.base64_encode($mail).'&key='.$key;
$x=misc::mail($mail,$title,$text);
if($x != true){
	$m->query("UPDATE `".DB_NAME."`.`".DB_PREFIX."users` SET `role` = 'user' WHERE email = '{$mail}'");
	$js = option::get('reg_jg');
	option::set('reg_jg',$js+1);
	setcookie("wmzz_tc_user",$name);
	setcookie("wmzz_tc_pw",EncodePwd($pw));
	ReDirect(SYSTEM_URL.'index.php?pub_plugin=reg_supervise&error_msg=验证邮件发送失败！已为你激活用户！请绑定百度账号。');
	die;
	}
else{
	option::set('reg_jg',0);
	ReDirect(SYSTEM_URL.'index.php?pub_plugin=reg_supervise&success_msg=请登录你的邮箱点击确认链接！否则无法登陆本站！');
	}die;
}	
function reg_supervise_jg() {
if (ROLE == 'admin' && !option::get('reg_jg')==0) {
echo '</br><font color="red"><span class="glyphicon glyphicon-warning-sign"></span> <b>警告：</b>邮件设置有误！！已有'.option::get('reg_jg').'个用户直接注册进入本站！！</font>';
}}
//addAction('login_page_1','reg_supervise_login');//登陆验证前台
//addAction('admin_login_1','reg_supervise_logincheck');//登陆验证后台
//以上不建议开启
addAction('admin_reg_1','reg_supervise_regcheck');//注册验证后台
addAction('reg_page_1','reg_supervise_reg');//注册验证前台
addAction('admin_reg_2','reg_supervise_yx');//邮箱验证
addAction('index_p_1','reg_supervise_jg');//邮件发送失败警告



?>