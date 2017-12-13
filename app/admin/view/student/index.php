<?php include '../app/admin/view/head.php';?>
<!-- TAB NAVIGATION -->
<ul class="nav nav-tabs" role="tablist">
	<li class="active"><a href="" >学生列表</a></li>
	<li ><a href="<?php echo u('add')?>" >学生添加</a></li>
</ul>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">学生管理</h3>
	</div>
	<div class="panel-body">
		<table class="table table-hover">
			<thead>
			<tr>
				<th>编号</th>
				<th>学生姓名</th>
				<th>学生性别</th>
				<th>学生年龄</th>
				<th>学生班级</th>
				<th>操作</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($field as $k=>$v){ ?>
				<tr>
					<td><?php echo $v['id']?></td>
					<td><?php echo $v['sname']?></td>
					<td><?php echo $v['ssex']?></td>
					<td><?php echo $v['sage']?></td>
					<td><?php echo $v['name']?></td>
					<td>
						<div class="btn-group btn-group-xs">
							<a href="<?php echo u('edit',['id'=>$v['id']])?>" class="btn btn-success">编辑</a>
							<button type="button" onclick="del(<?php echo $v['id'];?>)" class="btn btn-danger">删除</button>
						</div>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<script>
    function del(id){
        if(confirm('确定删除吗')){
            location .href = "?s=admin/student/del&id="+id;
        }
    }
</script>
<?php include '../app/admin/view/footer.php';?>




