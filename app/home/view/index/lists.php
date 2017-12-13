<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>学生风采展示</title>
    <link rel="stylesheet" href="./static/bs3/css/bootstrap.min.css">
</head>
<body>
    <div style="margin: 0 auto; margin-top: 30px; padding-left: 100px; padding-right: 100px;">
        <div class="container">
            <div class="row">
                <div class="panel panel-default">
                	  <div class="panel-heading">
                			<h2 class="panel-title" style="text-align: center; font-weight: 800; font-size: 1.5em;">
                                <?php echo $currentData['name']?>班学生数据
                            <a href="<?php echo u('index')?>" class="btn btn-primary btn-xs" style="float: right;">返回班级</a>
                            </h2>
                	  </div>
                	  <div class="panel-body">
                			<table class="table table-hover">
                				<thead>
                					<tr>
                						<th>编号</th>
                						<th>学生姓名</th>
                						<th>学生性别</th>
                						<th>学生年龄</th>
                					</tr>
                				</thead>
                				<tbody>
                                <?php foreach($stuData as $k=>$v){ ?>
                                    <tr>
                                        <td><?php echo $v['id']?></td>
                                        <td><?php echo $v['sname']?></td>
                                        <td><?php echo $v['ssex']?></td>
                                        <td><?php echo $v['sage']?></td>
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