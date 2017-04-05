<?php echo $this->session->flashdata('action_status'); ?>
<h1>Statistik</h1>
<div id="btn-add">
	<a href="<?php echo site_url('statistik/add');?>" class="btn btn-sm btn-primary">
		<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah
	</a>
</div>
<table class="table table-striped" id="dt-table">
	<thead>
		<tr>
			<th>#</th>
			<!-- <th>ID</th> -->
			<!--<th>Tahun</th>-->
            <th>Bulan</th>
            <th>Jumlah (Check In)</th>
            <th>Lama Tinggal</th>
            <th>Jumlah Kamar Terjual</th>
            <th>Jumlah Bed Terjual</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; ?>
		<?php foreach ($table as $value): ?>
			<tr>
				<td><?php echo $i; $i++; ?></td>
				<!-- <td><?php // echo $value->id; ?></td> -->
				<!--<td><?php //echo $value['tahun']; ?></td>-->
                <td><?php echo $value['bulan']; ?></td>
                <td><?php echo $value['wisman_check_in']+$value['wisnus_check_in']; ?></td>
                <td><?php echo $value['wisman_lama_tinggal']+$value['wisnus_lama_tinggal']; ?></td>
				<td><?php echo $value['kamar_terjual']; ?></td>
                <td><?php echo $value['bed_terjual']; ?></td>
                <td>
					<?php 
					echo anchor('statistik/detail/' . $value['id_survei'], '<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>', array(
						'class' => 'btn btn-sm btn-info',
						'data-toggle' => 'tooltip',
						'data-placement' =>'top',
						'title' => 'Detail')
					);
					?>
					<?php 
					echo anchor('statistik/delete/' . $value['id_survei'], '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', array(
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