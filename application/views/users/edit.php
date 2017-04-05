<div class="panel panel-primary">
	<div class="panel-heading">
		Edit Users
	</div>
	<div class="panel-body">		
		<?php echo form_open(uri_string(), array('id' => 'form', 'class' => 'form-horizontal')); ?>
		<div class="form-group">
			<label for="role" class="col-sm-2 control-label">Role</label>
			<div class="col-sm-10">
				<?php echo form_dropdown('role', $role, $data_edit->role); ?>
				<span class="help-inline"><?php echo form_error('role'); ?></span>		
			</div>
		</div>
		<div class="form-group">
			<label for="nama" class="col-sm-2 control-label">Nama Lengkap</label>
			<div class="col-sm-10">
				<?php echo form_input(array('id' => 'nama', 'name' => 'nama', 'value' => set_value('nama', $data_edit->nama), 'required'=>'required')); ?>
				<span class="help-inline"><?php echo form_error('nama'); ?></span>		
			</div>
		</div>
		<div class="form-group">
			<label for="email" class="col-sm-2 control-label">Email</label>
			<div class="col-sm-10">
				<?php echo form_input(array('id' => 'email', 'name' => 'email', 'value' => set_value('email', $data_edit->email), 'required'=>'required')); ?>
				<span class="help-inline"><?php echo form_error('email'); ?></span>		
			</div>
		</div>
		<div class="form-group">
			<label for="password" class="col-sm-2 control-label">Password</label>
			<div class="col-sm-10">
				<?php echo form_password(array('id' => 'password', 'name' => 'password', 'value' => set_value('password'))); ?>
				<span class="help-inline"><?php echo form_error('password'); ?></span>		
			</div>
		</div>
		<div class="form-group">
			<label for="confirm-password" class="col-sm-2 control-label">Konfirmasi Password</label>
			<div class="col-sm-10">
				<?php echo form_password(array('id' => 'confirm-password', 'name' => 'confirm-password', 'value' => set_value('confirm-password'))); ?>
				<span class="help-inline"><?php echo form_error('confirm-password'); ?></span>		
			</div>
		</div>
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary">Simpan</button>	
			<a href="<?php echo site_url('users');?>" class="btn btn-default">Batal</a>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>