            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">

                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Laporan
                        <small>Pengawasan Laporan pada SIM UKM</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?=base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">UKM</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- info selamat datang -->
                    <div class="alert alert-info alert-dismissable" style="padding:5px 35px 5px 5px; margin: 0 0 5px 0">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Di halaman ini Anda bisa memodifikasi dan menghapus/undo Laporan
                    </div>

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-12">
                            <div class="box box-info">
                                <div class="box-header">
                                    <!-- tools -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-sm btn-info" id="btn-refresh"><i class="fa fa-refresh">&nbsp;</i> Refresh</button>
                                        <button class="btn btn-sm btn-danger" id="btn-modsemua"><i class="fa fa-times">&nbsp;</i> Hapus Semua Data</button>
                                    </div>
                                    <!-- /.tools -->
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="table-data" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>UKM</th>
                                                <th>Pesan</th>
                                                <th>Dikirim</th>
                                                <th>Tujuan</th>
                                                <th>Status</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>

                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>UKM</th>
                                                <th>Pesan</th>
                                                <th>Dikirim</th>
                                                <th>Tujuan</th>
                                                <th>Status</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div>
                        </section><!-- /.Left col -->

                    </div><!-- /.row (main row) -->


                </section><!-- /.content -->

            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        

      <!-- Modal Hapus Laporan -->
      <div class="modal fade" id="modal-hapus" data-backdrop="static">
          <div class="modal-dialog" style="width: 26%;">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title"><i class="fa fa-book"></i> Hapus Laporan</h4>
                  </div>
                  <div class="modal-body">
                      <div class="box-body table-responsive">
                          <span id="form-pesan-hapus">
                          </span>
                          <?php echo form_open('data/hapusdata', 'id="form-hapus"') ?>
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-md-12">
                                          <input type="hidden" id="hapus-id" name="hapus-id" />
                                          <input type="hidden" id="hapus-nama" name="hapus-nama" />
                                          <p>Apakah Anda yakin ingin menghapus Data Laporan berikut ?</p>
                                          <div class="callout callout-info">
                                              <p>Nama UKM : <span id="hapus-namaukm"> </span></p>
                                              <p>Nama File : <span id="hapus-namafile"> </span></p>
                                          </div>
                                      
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="flat-red" name="hapus-file" value="hapusfile" />
                                                    Hapus beserta File
                                                </label>
                                            </div>
                                        </div>
                                        
                                            
                                  </div>
                              </div>
                              
                          </div>
                          <?php echo form_close(); ?>
                      </div><!-- /.box-body -->
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                      <button id="btn-hapus" type="button" class="btn btn-primary"><i class="fa fa-check"></i> Iya, Hapus</button>
                  </div>
              </div>
          </div>
      </div>

      <!-- Modal undo -->
      <div class="modal fade" id="modal-undo" data-backdrop="static">
          <div class="modal-dialog" style="width: 25%;">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title"><i class="fa fa-book"></i> Undo Data</h4>
                  </div>
                  <div class="modal-body">
                      <div class="box-body table-responsive">
                          <span id="form-pesan-undo">
                          </span>
                          <?php echo form_open('data/undodata', 'id="form-undo"') ?>
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-md-12">
                                      <input type="hidden" id="undo-id" name="undo-id" />
                                      <input type="hidden" id="undo-nama" name="undo-nama" />
                                      <p>Apakah Anda yakin ingin mengembalikan Data Laporan berikut ?</p>
                                      <div class="callout callout-info">
                                          <p>Nama UKM : <span id="undo-namaukm"> </span></p>
                                          <p>Nama File : <span id="undo-namafile"> </span></p>
                                      </div>

                                  </div>
                              </div>
                          </div>
                          <?php echo form_close(); ?>
                      </div><!-- /.box-body -->
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                      <button id="btn-undo" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Kembalikan</button>
                  </div>
              </div>
          </div>
      </div> <!-- /.modal-undo-->

        <!-- Modal Hapus Semua Data -->
        <div class="modal fade" id="modal-semua" data-backdrop="static">
          <div class="modal-dialog" style="width: 26%;">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title"><i class="fa fa-book"></i> Hapus Laporan</h4>
                  </div>
                  <div class="modal-body">
                      <div class="box-body table-responsive">
                          <span id="form-pesan-semua">
                          </span>
                          <?php echo form_open('data/hapusemua', 'id="form-semua"') ?>
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-md-12">
                                          <p>Apakah Anda yakin ingin menghapus semua Data Laporan ?</p>
                                      <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="flat-red" name="semua-file" value="hapusfile" />
                                                    Hapus beserta File
                                                </label>
                                            </div>
                                        </div>
                                  </div>
                              </div>
                          </div>
                          <input type="hidden" name="semua-id" value="<?=$this->access->get_roleid();?>" />
                          <?php echo form_close(); ?>
                      </div><!-- /.box-body -->
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                      <button id="btn-semua" type="button" class="btn btn-primary"><i class="fa fa-check"></i> Iya, Hapus</button>
                  </div>
              </div>
          </div>
        </div>

        <script type="text/javascript">
            function modalhapus(id, ukm, file){
                $('#form-pesan-hapus').html('');
                $('#modal-hapus').modal('show');
                $('#hapus-id').val(id);
                $('#hapus-nama').val(file);
                $('#hapus-namaukm').html(ukm);
                $('#hapus-namafile').html(file);
            }

            function modalundo(id, ukm, file){
                $('#form-pesan-undo').html('');
                $('#modal-undo').modal('show');
                $('#undo-id').val(id);
                $('#undo-nama').val(file);
                $('#undo-namaukm').html(ukm);
                $('#undo-namafile').html(file);
            }
            
            function resizeWindow(e){
                var newWindowWidth = $(window).width();
                var oTable = $('#table-data').dataTable();
                if(newWindowWidth > 1024){
                        /* Do Something */
                    oTable.fnSetColumnVis( 2, true );
                    oTable.fnSetColumnVis( 4, true );
                }else if((newWindowWidth >= 600) && (newWindowWidth <= 1050)){
                        /* Do Something */
                    oTable.fnSetColumnVis( 2, false );
                    oTable.fnSetColumnVis( 4, false );
                }else if(newWindowWidth < 600){

                }
            }

            
            $(document).ready(function() {
                

                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-red',
                    radioClass: 'iradio_flat-red'
                });
                
                $('#btn-modsemua').click(function(){
                    $('#modal-semua').modal('show');
                });
                
                $('#btn-refresh').click(function(){
                    $('#table-data').dataTable().fnReloadAjax();
                });
                
                $('#modal-hapus').on('shown.bs.modal', function (e) {
                    $('#btn-hapus').focus();
                });

                $('#modal-redo').on('shown.bs.modal', function (e) {
                    $('#btn-redo').focus();
                });
                
                $('#modal-semua').on('shown.bs.modal', function (e) {
                    $('#btn-semua').focus();
                });

                $('#table-data').dataTable({
                    "sPaginationType": "bootstrap",
                    "bProcessing": false,
                    "bServerSide": true,
                    "bJQueryUI": true,
                    "iDisplayLength":10,
                    "sAjaxSource": "<?=base_url()?>data/getdata",
                    "aoColumns": [
                            {"bSearchable": false, "bSortable": false, "sWidth": 30},
                            {"bSearchable": false, "bSortable": false},
                            {"bSearchable": false, "bSortable": false},
                            {"bSearchable": false, "bSortable": false, "sWidth": 120},
                            {"bSearchable": false, "bSortable": false, "sWidth": 120},
                            {"bSearchable": false, "bSortable": false, "sWidth": 100},
                            {"bSearchable": false, "bSortable": false}
                    ],

                });

                // undo
                $('#btn-undo').click(function(){
                    $('#form-undo').submit();
                    $('#btn-undo').addClass('disabled');
                });

                $('#form-undo').submit(function(){
                    $.ajax({
                        url:"<?=base_url()?>data/undodata",
                        type:"POST",
                        data:$('#form-undo').serialize(),
                        cache: false,
                        success:function(respon){
                            var obj = $.parseJSON(respon);
                            if(obj.status==1){
                                $('#form-pesan-undo').html(pesan_succ(obj.pesan));
                                setTimeout(function(){$('#form-pesan-undo').html('')}, 2000);
                                setTimeout(function(){$('#modal-undo').modal('hide')}, 2500);
                                setTimeout(function(){ $('#table-data').dataTable().fnReloadAjax() }, 2500);
                            }else{
                                $('#form-pesan-undo').html(pesan_err(obj.pesan));
                                setTimeout(function(){$('#form-pesan-undo').html('')}, 3000);
                            }
                            $('#btn-undo').removeClass('disabled');
                        }
                    });
                    return false;
                });

                // Hapus data
                $('#btn-hapus').click(function(){
                    $('#form-hapus').submit();
                    $('#btn-hapus').addClass('disabled');
                });
                $('#form-hapus').submit(function(){
                    $.ajax({
                        url:"<?=base_url()?>data/hapusdata",
                        type:"POST",
                        data:$('#form-hapus').serialize(),
                        cache: false,
                        success:function(respon){
                            var obj = $.parseJSON(respon);
                            if(obj.status==1){
                                $('#form-pesan-hapus').html(pesan_succ(obj.pesan));
                                setTimeout(function(){$('#form-pesan-hapus').html('')}, 2000);
                                setTimeout(function(){$('#modal-hapus').modal('hide')}, 2500);
                                setTimeout(function(){ $('#table-data').dataTable().fnReloadAjax() }, 2500);
                            }else{
                                $('#form-pesan-hapus').html(pesan_err(obj.pesan));
                                setTimeout(function(){$('#form-pesan-hapus').html('')}, 5000);
                            }

                            $('#btn-hapus').removeClass('disabled');
                        }
                    });
                    return false;
                });
                
                // Hapus semua data
                $('#btn-semua').click(function(){
                    $('#form-semua').submit();
                    $('#btn-semua').addClass('disabled');
                });
                $('#form-semua').submit(function(){
                    $.ajax({
                        url:"<?=base_url()?>data/hapusemua",
                        type:"POST",
                        data:$('#form-semua').serialize(),
                        cache: false,
                        success:function(respon){
                            var obj = $.parseJSON(respon);
                            if(obj.status==1){
                                $('#form-pesan-semua').html(pesan_succ(obj.pesan));
                                setTimeout(function(){$('#form-pesan-semua').html('')}, 2000);
                                setTimeout(function(){$('#modal-semua').modal('hide')}, 2500);
                                setTimeout(function(){ $('#table-data').dataTable().fnReloadAjax() }, 2500);
                            }else{
                                $('#form-pesan-semua').html(pesan_err(obj.pesan));
                                setTimeout(function(){$('#form-pesan-semua').html('')}, 5000);
                            }

                            $('#btn-semua').removeClass('disabled');
                        }
                    });
                    return false;
                });
                
                $(window).bind("resize", resizeWindow);
                resizeWindow();

            
            });
        </script>

    </body>
</html>