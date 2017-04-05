<?php echo $this->session->flashdata('action_status'); ?>
<h1>Users</h1>
<div id="btn-add">
	<a href="<?php echo site_url('users/add');?>" class="btn btn-sm btn-primary">
		<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah
	</a>
</div>
<table class="table table-striped" id="dt-table">
	<thead>
		<tr>
			<th>#</th>
			<!-- <th>ID</th> -->
			<th>Nama</th>
			<th>Email</th>
			<th>Role</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; ?>
		<?php foreach ($table as $value): ?>
			<tr>
				<td><?php echo $i; $i++; ?></td>
				<!-- <td><?php // echo $value->id; ?></td> -->
				<td><?php echo $value->nama; ?></td>
				<td><?php echo $value->email; ?></td>
				<td><?php echo $value->role; ?></td>
				<td>
					<?php 
					echo anchor('users/edit/' . $value->id, '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>', array(
						'class' => 'btn btn-sm btn-success',
						'data-toggle' => 'tooltip',
						'data-placement' =>'top',
						'title' => 'Edit')
					);
					?>
					<?php 
					echo anchor('users/delete/' . $value->id, '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', array(
						'class' => 'btn btn-sm btn-danger',
						'data-toggle' => 'tooltip',
						'data-placement' =>'top',
						'title' => 'Hapus',
						'onclick' => 'return confirm_delete();')
					);
					?>				
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>