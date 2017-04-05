<div>
    <h2><?php echo $nama_hotel; ?></h2>
    <p>Bulan : <?php echo $bulan.' '.$tahun;?></p>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#wisman" aria-controls="wisman" role="tab" data-toggle="tab">Wisman</a></li>
    <li role="presentation"><a href="#wisnus" aria-controls="wisnus" role="tab" data-toggle="tab">Wisnus</a></li>
    <li role="presentation"><a href="#tamu-menginap" aria-controls="tamu-menginap" role="tab" data-toggle="tab">Tamu Menginap</a></li>
    </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="wisman">
        <?php $this->load->view('wisman/index'); ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="wisnus">
        <?php $this->load->view('wisnus/index'); ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="tamu-menginap">
        <?php $this->load->view('tamu/index'); ?>
    </div>
  </div>

</div>