<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?> - Dinas Pariwisata DIY</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-theme.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/buttons.dataTables.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/sticky-footer-navbar.css'); ?>">
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo site_url();?>">Dinas Pariwisata DIY</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li <?php if($this->uri->segment(1)=="home" || $this->uri->segment(1)==""){echo 'class="active"';}?>>
						<a href="<?php echo site_url('home');?>">Dashboard</a>
					</li>
					<li <?php if($this->uri->segment(1)=="statistik"){echo 'class="active"';}?>>
						<a href="<?php echo site_url('statistik');?>">Statistik</a>
					</li>
					<li <?php if($this->uri->segment(1)=="users"){echo 'class="active"';}?>>
						<a href="<?php echo site_url('users');?>">Users</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('nama'); ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Profil</a></li>
							<li><a href="#">Ganti Password</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?php echo site_url('auth/logout');?>">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<div class="container">
		<?php echo $body; ?>
	</div>
	<!-- footer -->
	<footer class="footer">
		<div class="container">
			<p class="text-muted">Dinas Pariwisata DIY &copy; 2017</p>
		</div>
	</footer>
	<!-- javascript -->
	<script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/dataTables.bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/dataTables.buttons.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/buttons.print.min.js'); ?>"></script>
	<script>
		function confirm_delete()
		{			
			var get_confirm = confirm('Apakah Anda yakin akan menghapus data ini?');
			if(get_confirm == true)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip(); 
			var t = $('.dt-table').DataTable( {
				"dom": "<'row'<'col-sm-6'<'btn-add'>><'col-sm-2'><'col-sm-4'Bf>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-5'i><'col-sm-7'p>>",
				"columnDefs": [ {
					"searchable": false,
					"orderable": false,
					"targets": [0, -1]
				} ],
				"order": [[ 1, 'asc' ]],
				"buttons": ['print']
			} );
			t.on( 'order.dt search.dt', function () {
				t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
					cell.innerHTML = i+1;
				} );
			} ).draw();
			$("div.btn-add").html($('#btn-add'));
		});
	</script>
</body>
</html>