<?php
if (!defined('SYSTEM_ROOT')) { die('Insufficient Permissions'); }
if (isset($_GET['ok'])) {
echo '<div class="alert alert-success">保存成功</div>';
}
?>
<h2>
极验验证模块设置
</h2>
<br/>
<form action="setting.php?mod=plugin:reg_supervise" method="post">
<div class="table-responsive">
<table class="table table-hover">
<thead>
<th style="width:15%">
参数
</th>
<th style="width:90%">
值
</th>
</thead>
<tr>
<td>
当前样式<?php
if(option::xget('reg_supervise', 'ys')==popup ) { echo '弹出式';}
elseif(option::xget('reg_supervise', 'ys')==float ) { echo '浮动式';}
elseif(option::xget('reg_supervise', 'ys')==embed ) { echo '展开式';}
else {echo "默认";}; ?>
</td>
<td>
<select name="ys" class="form-control">
<option value="<?php echo option::xget('reg_supervise', 'ys'); ?>">保持当前验证码样式</option>
<option value="popup">更改样式为：弹出式（推荐）</option>
<option value="float">更改样式为：浮动式</option>
<option value="embed">更改样式为：展开式（不推荐）</option>
</select>
</td>
</tr>
<tr>
<td>
极验id
</td>
<td>
<input type="text" name="geetest_id" value="<?php echo option::xget('reg_supervise', 'geetest_id'); ?>"
class="form-control">

</td>
</tr>
<tr>
<td>
极验key
</td>
<td>
<input type="text" name="geetest_key" value="<?php echo option::xget('reg_supervise', 'geetest_key'); ?>"
class="form-control">
</td>
</tr>
</table>
</div>
<input type="submit" class="btn btn-primary" value="提交更改">
</form>
