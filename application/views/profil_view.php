            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">

                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Profil
                        <small>Profil user pada SIM UKM</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?=base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Profil</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- info selamat datang -->
                    <div class="alert alert-info alert-dismissable" style="padding:5px 35px 5px 5px; margin: 0 0 5px 0">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Di halaman ini Anda bisa memodifikasi informasi dan mengganti password Anda
                    </div>

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-8">
                            <div class="box box-info">
                                <div class="box-header">
                                    <!-- tools -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-sm btn-info" id="btn-edit-info"><i class="fa fa-pencil"></i> Edit Info</button>
                                        <button class="btn btn-sm btn-success" id="btn-ganti-password"><i class="fa fa-lock"></i> Ganti Password</button>
                                    </div>
                                    <!-- /.tools -->
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="callout callout-info">
                                        <h4>Username</h4>
                                        <p><?=isset($datauser) ? $datauser->USER_NAME : ""?></p>
                                    </div>
                                    <div class="callout callout-info">
                                        <h4>Email</h4>
                                        <p><?=isset($datauser) ? $datauser->USER_MAIL : ""?></p>
                                    </div>
                                    <div class="callout callout-info">
                                        <h4>Dibuat</h4>
                                        <p><?=isset($datauser) ? $datauser->USER_CREATED : ""?></p>
                                    </div>
                                    <div class="callout callout-info">
                                        <h4>UKM</h4>
                                        <p><?=isset($datauser) ? $datauser->UKM : ""?></p>
                                    </div>
                                </div><!-- /.box-body -->
                            </div>
                        </section><!-- /.Left col -->
                        <!-- Right Col -->
                        <section class="col-lg-4">
                            <div class="box box-warning">
                                <div class="box-header">
                                    <h3 class="box-title">Hak Akses</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <p>Hak akses Anda mempunyai level : <b><?=isset($datauser) ? $datauser->Role : ""?></b></p>
                                    <p>Yang bisa mengakses : </p>
                                    <ol>
                                        <?php if(!empty($dataakses)) { foreach ($dataakses as $key ) { ?>
                                            <li><?=$key->akses_menu;?></li>
                                        <?php } } ?>
                                    </ol>
                                </div><!-- /.box-body -->
                            </div>
                        </section><!-- /.Right col -->

                    </div><!-- /.row (main row) -->


                </section><!-- /.content -->

            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

      <!-- Modal Edit User -->
      <div class="modal fade" id="modal-edit" data-backdrop="static">
          <div class="modal-dialog" style="width: 30%;">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title"><i class="fa fa-user"></i> Edit Info</h4>
                  </div>
                  <div class="modal-body">
                      <div class="box-body table-responsive">
                          <span id="form-pesan-edit">
                          </span>
                          <?php echo form_open('user/edituser', 'id="form-edit"') ?>
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">

                                      <div class="input-group">
                                        <span class="input-group-addon">Username:</span>
                                        <input type="text" class="form-control" id="edit-username" name="edit-username" value="<?=isset($datauser) ? $datauser->USER_NAME : ""?>" placeholder="Username min. 3 Karakter" />
                                      </div><!-- /.input group -->
                                    </div>
                                    <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">Email:</span>
                                        <input type="email" class="form-control" id="edit-email" name="edit-email" value="<?=isset($datauser) ? $datauser->USER_MAIL : ""?>" placeholder="Email" />
                                      </div><!-- /.input group -->
                                    </div>
                                    <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">Role:</span>
                                        <select class="form-control" id="edit-role" name="edit-role" readonly>
                                            <option value="<?=isset($datauser) ? $datauser->USER_ROLE : ""?>"><?=isset($datauser) ? $datauser->Role : ""?></option>
                                        </select>
                                      </div><!-- /.input group -->
                                    </div>
                                    <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">UKM:</span>
                                        <select class="form-control" id="edit-ukm" name="edit-ukm" readonly>
                                            <option value="<?=isset($datauser) ? $datauser->UKM_ID : ""?>"><?=isset($datauser) ? $datauser->UKM : ""?></option>
                                          </select>
                                        </div><!-- /.input group -->
                                      </div>
                                    <div class="form-group">
                                      <label>Tanggal Dibuat :</label>
                                      <div class="input-group">
                                        <div class="input-group-addon">
                                          <i class="fa fa-sort-numeric-asc"></i>
                                        </div>
                                        <input type="text" class="form-control" id="edit-tgl" name="edit-tgl" value="<?=isset($datauser) ? $datauser->USER_CREATED : ""?>" readonly="" />
                                        <input type="hidden" id="edit-id" name="edit-id" value="<?=isset($datauser) ? $datauser->USER_ID : ""?>" readonly="" />
                                        <input type="hidden" id="edit-tempuname" name="edit-tempuname" value="<?=isset($datauser) ? $datauser->USER_NAME : ""?>" readonly="" />
                                      </div><!-- /.input group -->

                                    </div>
                                  </div>


                              </div>
                              <?php echo form_close(); ?>
                          </div><!-- /.box-body -->
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                      <button id="btn-edit" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                  </div>
              </div>
          </div>
      </div> <!-- /.modal-edit -->

      <!-- Modal Password -->
      <div class="modal fade" id="modal-password" data-backdrop="static">
          <div class="modal-dialog" style="width: 25%;">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title"><i class="fa fa-user"></i> Ganti Password</h4>
                  </div>
                  <div class="modal-body">
                      <div class="box-body table-responsive">
                          <span id="form-pesan-password">
                          </span>
                          <?php echo form_open('user/gantipassword', 'id="form-password"') ?>
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <div class="input-group">
                                              <span class="input-group-addon">Username:</span>
                                              <input type="text" id="pass-name" name="pass-name" value="<?=isset($datauser) ? $datauser->USER_NAME : ""?>" readonly="" class="form-control" />
                                          </div><!-- /.input group -->
                                      </div>
                                      <div class="form-group">
                                          <label>Password Baru :</label>
                                          <div class="input-group">
                                              <div class="input-group-addon">
                                                  <i class="fa fa-lock"></i>
                                              </div>
                                              <input type="password" class="form-control" id="pass-baru" name="pass-baru" placeholder="Password Baru" />
                                          </div><!-- /.input group -->
                                          <br>
                                          <div class="input-group">
                                              <div class="input-group-addon">
                                                  <i class="fa fa-lock"></i>
                                              </div>
                                              <input type="password" class="form-control" id="pass-conf" name="pass-conf" placeholder="Konfirmasi Password Baru" />
                                              <input type="hidden" id="pass-id" name="pass-id" value="<?=isset($datauser) ? $datauser->USER_ID : ""?>" readonly="" />
                                          </div><!-- /.input group -->
                                      </div>

                                  </div>
                              </div>
                          </div>
                          <?php echo form_close(); ?>
                      </div><!-- /.box-body -->
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                      <button id="btn-simpanpass" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                  </div>
              </div>
          </div>
      </div> <!-- /.modal-password-->

        <script type="text/javascript">

            $(document).ready(function() {
                $('#modal-edit').on('shown.bs.modal', function (e) {
                    $('#edit-username').focus();
                });

                $('#modal-password').on('shown.bs.modal', function (e) {
                    $('#pass-baru').focus();
                });

                $('#btn-ganti-password').click(function(){
                    $('#form-pesan-password').html('');
                    $('#modal-password').modal('show');
                });

                $('#btn-edit-info').click(function(){
                    $('#form-pesan-edit').html('');
                    $('#modal-edit').modal('show');
                });

                // Edit password
                $('#btn-simpanpass').click(function(){
                    $('#form-password').submit();
                    $('#btn-simpanpass').addClass('disabled');
                });

                $('#form-password').submit(function(){
                    $.ajax({
                        url:"<?=base_url()?>user/gantipassword",
                        type:"POST",
                        data:$('#form-password').serialize(),
                        cache: false,
                        success:function(respon){
                            var obj = $.parseJSON(respon);
                            if(obj.status==1){
                                $('#form-pesan-password').html(pesan_succ(obj.pesan));
                                setTimeout(function(){$('#form-pesan-password').html('')}, 2000);
                                setTimeout(function(){$('#modal-password').modal('hide')}, 2500);
                                setTimeout(function(){ location.reload(); }, 2500);
                            }else{
                                $('#form-pesan-password').html(pesan_err(obj.pesan));
                                setTimeout(function(){$('#form-pesan-password').html('')}, 3000);
                            }
                            $('#btn-simpanpass').removeClass('disabled');
                        }
                    });
                    return false;
                });

                // Edit counter
                $('#btn-edit').click(function(){
                    $('#form-edit').submit();
                    $('#btn-edit').addClass('disabled');
                });

                $('#form-edit').submit(function(){
                    $.ajax({
                        url:"<?=base_url()?>user/edituser",
                        type:"POST",
                        data:$('#form-edit').serialize(),
                        cache: false,
                        success:function(respon){
                            var obj = $.parseJSON(respon);
                            if(obj.status==1){
                                $('#form-pesan-edit').html(pesan_succ(obj.pesan));
                                setTimeout(function(){$('#form-pesan-edit').html('')}, 2000);
                                setTimeout(function(){$('#modal-edit').modal('hide')}, 2500);
                                setTimeout(function(){ location.reload(); }, 2500);
                            }else{
                                $('#form-pesan-edit').html(pesan_err(obj.pesan));
                                setTimeout(function(){$('#form-pesan-edit').html('')}, 2000);
                            }

                            $('#btn-edit').removeClass('disabled');
                        }
                    });
                    return false;
                });


            });
        </script>

    </body>
</html>
