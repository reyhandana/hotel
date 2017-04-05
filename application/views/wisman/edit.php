<?php echo $this->session->flashdata('action_status'); ?>
<h3>Edit Data Wisman</h3>
<?php echo form_open(uri_string(), array('id' => 'form', 'class' => 'form-horizontal')); ?>
    <table class="table table-striped">
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
                    <td><?php echo $value->nama; ?></td>
                    <td>
                        <?php echo form_input(array('id' => 'jumlah', 'name' => 'jumlah[' . $value->id . ']', 'class' => 'input-mini text-right', 'value' => set_value('jumlah[' . $value->id . ']'), 'autocomplete' => 'off')); ?>
                    </td>
                    <td>
                        <?php echo form_input(array('id' => 'lama', 'name' => 'lama[' . $value->id . ']', 'class' => 'input-mini text-right', 'value' => set_value('lama[' . $value->id . ']'), 'autocomplete' => 'off')); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php echo form_submit(array('class' => 'btn btn-primary', 'name' => 'btn-submit'), 'Simpan'); ?>
<?php echo anchor('statistik', 'Batal', array('class' => 'batal-btn btn')); ?>
<a href="#wisnus" aria-controls="wisnus" role="tab" data-toggle="tab">Next</a>
<?php echo form_close(); ?>