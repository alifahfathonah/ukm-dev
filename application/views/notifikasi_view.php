            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">

                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Notifikasi
                        <small>Daftar Notifikasi yang diterima</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?=base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Notifikasi</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- info selamat datang -->
                    <div class="alert alert-info alert-dismissable" style="padding:5px 35px 5px 5px; margin: 0 0 5px 0">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Di halaman ini kamu bisa melihat semua notifikasi yang ditujukan kepadamu
                    </div>

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-12">
                            <div class="box box-info">
                                <div class="box-header">
                                    <!-- tools -->
                                    <div class="pull-right box-tools">
                                        <!-- button with a dropdown -->
                                        <div class="btn-group">
                                            <button class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear"></i> Opsi</button>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li><a href="<?=current_url()."/bacasmua";?>">Tandai Semua telah Dibaca</a></li>
                                                <li><a href="<?=current_url()."/hapusmua";?>">Hapus Semua Notifikasi</a></li>
                                            </ul>
                                        </div>

                                    </div>
                                    <!-- /.tools -->
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tbody>

                                        <?php
                                        if(!empty($datanotif)) {
                                          foreach ($datanotif as $key) {
                                        ?>
                                        <tr>
                                            <td><span class="label label-<?=$key->tipe_nama;?>"><?=$key->teks ." / " . $key->NOTIF_TIME;?></span> <?=substr($key->NOTIF_ACTIVITY,0);?> { <i>dikirim oleh <?=$key->user_name;?></i> }.</td>
                                        </tr>
                                        <?php } } else {  ?>
                                        <tr>
                                            <td>Tidak ada notifikasi.</td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div>
                        </section><!-- /.Left col -->

                    </div><!-- /.row (main row) -->


                </section><!-- /.content -->

            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <script type="text/javascript">
            function refresh_jumlah(){
                $.getJSON('<?=base_url();?>dashboard/get_databox', function(obj) {
                    $('#boxukm').html(obj.boxukm);
                    $('#boxuser').html(obj.boxuser);
                    $('#boxlog').html(obj.boxlog);
                    $('#boxlaporan').html(obj.boxlaporan);
                    $('#boxnotif').html(obj.boxnotif);
                    $('#boxanggota').html(obj.boxanggota);
                    $('#boxagenda').html(obj.boxagenda);
                    $('#boxrem').html(obj.boxrem);
                });
            }

            $(document).ready(function() {
                refresh_jumlah();
                var auto_refresh = setInterval(
                    function(){
                        refresh_jumlah();
                    }, 10000
                )
            });
        </script>

    </body>
</html>
