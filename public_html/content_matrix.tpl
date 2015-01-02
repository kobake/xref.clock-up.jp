<!-- 左サイドバーメニュー参考：http://ironsummitmedia.github.io/startbootstrap-sb-admin-2/pages/index.html -->
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3 col-md-2 sidebar">

			<!-- ※nav-sidebarクラスを付けると、active部分が強調表示になる -->
			<ul id="navbar" class="nav nav-first-level nav-sidebar"> 
				<!--
				<li class="sidebar-search">
					<div class="input-group custom-search-form">
						<input type="text" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</li>
				  -->

				{$menus}

			</ul>



			<!-- アクティブ状態（選択状態）サンプル
			<li class="active"><a href="#">管理 <span class="sr-only">(current)</span></a></li>
			-->

		</div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<!-- <h1 class="page-header">Database</h1> -->

			{$sections}

		</div>
	</div>
</div>
