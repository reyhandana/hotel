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
			<!--<th>No</th>-->
            <th>Jumlah Kamar yang Bisa Dijual</th>
            <th>Jumlah Kamar yang Terjual</th>
            <th>Jumlah Bed yang Bisa Dijual</th>
            <th>Jumlah Bed yang Terjual</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; ?>
		<?php //foreach ($tamu as $tamu): ?>
			<tr>
				<!--<td><?php //echo $i; $i++; ?></td>-->
				<td><?php echo $tamu['jml_kamar']; ?></td>
				<td><?php echo $tamu['jml_bed']; ?></td>
				<td><?php echo $terjual['kamar_terjual']; ?></td>
                <td><?php echo $terjual['bed_terjual']; ?></td>
			</tr>
		<?php //endforeach; ?>
	</tbody>
</table>