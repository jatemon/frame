<?php include '../app/admin/view/head.php';?>
            <!-- TAB NAVIGATION -->
			<ul class="nav nav-tabs" role="tablist">
				<li ><a href="<?php echo u('index')?>" >学生列表</a></li>
				<li class="active"><a href="<?php echo u('add')?>" >学生添加</a></li>
			</ul>
            <form action="" method="POST" class="form-horizontal" role="form">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">学生管理</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">学生姓名</label>
                            <div class="col-sm-10">
                                <input type="text" name="sname" class="form-control"  value="<?php echo $oldData['sname']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">学生性别</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="ssex"  value="男" <?php if($oldData['ssex']=='男'){ ?>checked<?php } ?>>男
                                    </label>
                                    <label>
                                        <input type="radio" name="ssex"  value="女" <?php if($oldData['ssex']=='女'){ ?>checked<?php } ?>>女
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">学生年龄</label>
                            <div class="col-sm-10">
                                <input type="number" name="sage" class="form-control" value="<?php echo $oldData['sage']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">学生班级</label>
                            <div class="col-sm-10">
                                <select name="gid" class="form-control">
                                	<option value=""> -- Select One -- </option>
                                    <?php foreach($gradeData as $k=>$v){ ?>
                                	<option value="<?php echo $v['id']?>"  <?php if($oldData['gid']==$v['id']){ ?>selected<?php } ?>   > -- <?php echo $v['name']?> -- </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary">提交</button>
            </form>
<?php include '../app/admin/view/footer.php';?>




