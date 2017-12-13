<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>欢迎光临学生管理系统</title>
    <link rel="stylesheet" href="./static/bs3/css/bootstrap.min.css">
</head>
<body>
    <div style="margin: 0 auto; margin-top: 30px; padding-left: 100px; padding-right: 100px;">
        <div class="container">
            <div class="row">
                <div class="panel panel-default">
                	  <div class="panel-heading">
                			<h2 class="panel-title" style="text-align: center; font-weight: 800; font-size: 1.5em;">班级数据</h2>
                	  </div>
                	  <div class="panel-body">
                			<table class="table table-hover">
                				<thead>
                					<tr>
                						<th>编号</th>
                						<th>班级名称</th>
                						<th>操作</th>
                					</tr>
                				</thead>
                				<tbody>
                                <?php foreach($gradeData as $k=>$v){  ?>
                					<tr>
                						<td><?php echo $v['id']?></td>
                						<td><?php echo $v['name']?></td>
                						<td>
                                            <div class="btn-group btn-group-xs">
                                                <a href="<?php echo u('lists',['id'=>$v['id']]);?>" class="btn btn-success">查看学生</a>
                                            </div>
                                        </td>
                					</tr>
                                <?php } ?>
                				</tbody>
                			</table>
                	  </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>