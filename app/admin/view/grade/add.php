<?php include '../app/admin/view/head.php';?>
            <!-- TAB NAVIGATION -->
			<ul class="nav nav-tabs" role="tablist">
				<li ><a href="<?php echo u('index')?>" >班级列表</a></li>
				<li class="active"><a href="<?php echo u('add')?>" >班级添加</a></li>
			</ul>
            <form action="" method="POST" class="form-horizontal" role="form">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">班级管理</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">班级名称</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary">提交</button>
            </form>
<?php include '../app/admin/view/footer.php';?>




