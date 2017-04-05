<?php echo $this->session->flashdata('action_status'); ?>
<h3>Wisman</h3>
<!--<div id="btn-add">-->
	<a href="<?php echo site_url('wisman/edit');?>" class="btn btn-sm btn-success">
		<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit
	</a>
<!--</div>-->
<table class="table table-striped dt-table">
	<thead>
		<tr>
			<th>No</th>
			<th>Asal Wisman</th>
            <th>Jumlah (Check In)</th>
            <th>Lama Tinggal</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; ?>
		<?php foreach ($wisman as $value): ?>
			<tr>
				<td><?php echo $i; $i++; ?></td>
				<td><?php echo $value['nama']; ?></td>
				<td><?php echo $value['jumlah_check_in']; ?></td>
				<td><?php echo $value['lama_tinggal']; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>