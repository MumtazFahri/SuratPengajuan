<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>CodePen - Bootstrap Multi step form with progress bar</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/css/intlTelInput.css'>
  <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css'>
  <link rel="stylesheet" href="../css/style.css">


  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
</head>

<body>
  <!-- partial:index.partial.html -->
  <!-- Multi step form -->
  <section class="multi_step_form">
    <form id="msform">
      <!-- Tittle -->
      <div class="tittle">
        <h2>Verification Process</h2>
        <p>In order to use this service, you have to complete this verification process</p>
      </div>
      <!-- progressbar -->
      <ul id="progressbar">
        <li class="active">Verify Phone</li>
        <li>Upload Documents</li>
        <li>Security Questions</li>
      </ul>
      <!-- fieldsets -->
      <fieldset>
        <div class="custom-form">
          <div class="form-group" style="margin-bottom:12px">
            <input type="text" name="nama_kegiatan" class="form-control custom-form-control" required="required"
              id="nama_kegiatan" autocomplete="off" placeholder="Nama Kegiatan">
          </div>
          <div class="form-group has-select">
            <select class="form-control" name="jenis_date" id="jenis_date" id="phone" required>
              <option style="text-indent: -9999px;font-size: 0px;" disabled selected value="">Tanggal Pengajuan</option>
              <option value="Periode">Periode</option>
              <option value="Custom">Custom</option>
            </select>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <input type="text" name="tanggal_kegiatan" id="datepicker" class="form-control custom-form-control"
                  required="required" autocomplete="off" placeholder="Mulai kegiatan"><label id="lbl_mulai"></label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <input type="text" name="akhir_kegiatan" id="datepicker2" class="form-control custom-form-control"
                  required="required" autocomplete="off" placeholder="Berakhir kegiatan"><label id="lbl_akhir"></label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <input type="text" name="periode_penugasan" class="form-control custom-form-control" required="required"
                  id="datepicker3" autocomplete="off" placeholder="Periode Penugasan"><label id="lbl_mulai1"></label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <input type="text" name="akhir_periode_penugasan" class="form-control custom-form-control"
                  required="required" id="datepicker4" autocomplete="off"><label id="lbl_akhir1"
                  placeholder="Akhir Periode Penugasan"></label>
              </div>
            </div>
          </div>
          <div class="form-group has-select">
            <select class="form-control drop" name="periode_value" id="periode_value" required>
              <option style="text-indent: -9999px;font-size: 0px;" disabled selected value="">Pilih Periode</option>
              <option value="Ganjil">2024/2025 Ganjil</option>
              <option value="Genap">2024/2025 Genap</option>
              <option value="Ganjil">2025/2026 Ganjil</option>
              <option value="Genap">2025/2026 Genap</option>
              <option value="Ganjil">2026/2027 Ganjil</option>
              <option value="Genap">2026/2027 Genap</option>
              <option value="Ganjil">2027/2028 Ganjil</option>
              <option value="Genap">2027/2028 Genap</option>
            </select>
          </div>
          <div class="form-group" style="margin-bottom:12px">
            <input type="text" name="tempat_kegiatan" class="form-control custom-form-control" required="required"
              autocomplete="off" placeholder="Tempat Kegiatan">
          </div>
          <div class="form-group" style="margin-bottom:12px">
            <input type="text" name="penyelenggara" class="form-control custom-form-control" required="required"
              autocomplete="off" placeholder="Penyelenggara">
          </div>
        </div>
        <button type="button" class="action-button previous_button">Back</button>
        <button type="button" class="next action-button">Continue</button>
      </fieldset>
      <fieldset>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group has-select">
              <select class="form-control" name="jenis_pengajuan" id="jenis_pengajuan" required>
                <option style="text-indent: -9999px;font-size: 0px;" disabled selected value="">Jenis Pengajuan
                </option>
                <option value="Kelompok">Kelompok</option>
                <option value="Perorangan">Perorangan</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group has-select">
              <select class="form-control" name="lingkup_penugasan" id="lingkup_penugasan" required>
                <option style="text-indent: -9999px;font-size: 0px;" disabled selected value="">Status Kepegawaian
                </option>
                <option value="Dosen">Dosen </option>
                <option value="TPA">TPA </option>
                <option value="Dosen dan TPA">Dosen dan TPA </option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group has-select">
          <select class="form-control" name="jenis_penugasan" id="jenis_penugasan_perorangan">
            <option style="text-indent: -9999px;font-size: 0px;" disabled selected value="">Jenis Penugasan</option>
            <option value="Juri">Juri </option>
            <option value="Pembicara">Pembicara </option>
            <option value="Narasumber">Narasumber </option>
            <option value="Penugasan Lainnya">Lainnya </option>
          </select>
          <input type="text" class="form-control custom-form-control" name="penugasan_lainnya_perorangan"
            id="penugasan_lainnya_perorangan" cols="30" rows="1" placeholder="Masukan Jenis Penugasan Lainnya"
            style="margin-top:12px"></input>
        </div>
        <div class="form-group has-select">
          <select class="form-control" name="jenis_penugasan" id="jenis_penugasan_kelompok">
            <option style="text-indent: -9999px;font-size: 0px;" disabled selected value="">Jenis Penugasan</option>
            <option value="Tim">Tim </option>
            <option value="Kepanitiaan">Kepanitiaan</option>
            <option value="Penugasan Lainnya">Lainnya </option>
          </select>
          <input type="text" class="form-control custom-form-control" name="penugasan_lainnya_kelompok"
            id="penugasan_lainnya_kelompok" cols="30" rows="1" placeholder="Masukan Jenis Penugasan Lainnya"
            style="margin-top:12px"></input>
        </div>
        <div class="row">
          <div class="col-md-2">
            <input type="text" name="nip[]" class="form-control custom-form-control" id="nip" required="required"
              autocomplete="off" />
            <label style="margin-left:16px; ">NIP</label>
            <small class="form-text text-danger"></small>
          </div>
          <div class="col-md-3">
            <input type="text" name="nama_dosen" id="nama_dosen" class="form-control custom-form-control"><label
              style="margin-left:16px; ">Nama Dosen</label>
          </div>
          <div class="col-md-3">
            <input type="text" name="jabatan" id="jabatan" class="form-control custom-form-control"><label
              style="margin-left:16px; ">Jabatan</label>
          </div>
          <div class="col-md-3">
            <input type="text" name="divisi[]" id="divisi" class="form-control custom-form-control"><label
              style="margin-left:16px;" id="lbldivisi">Divisi</label>
          </div>
          <div class="col-md-1" id="tambahPanitia">
            <i id="addBtn" class="fas fa-plus" style="margin-top: 12px;"></i>
          </div>
        </div>
        <button type="button" class="action-button previous previous_button">Back</button>
        <button type="button" class="next action-button">Continue</button>
      </fieldset>
      <fieldset>
        <div class="form-group" style="margin-bottom:12;">
          <div class="row">
            <div class="col-md-11" style="margin-bottom:12px">
              <label for="eviden" style="margin-left: 16px;"><b>Eviden</b></label>
              <input type="file" name="eviden[]" id="eviden" class="form-control" style="padding:13px 16px"
                value="<?= set_value('eviden[]') ?>">
              <span id="chk-error"></span>
            </div>
            <div class="col-md-1">
              <i id="addEviden" class="fas fa-plus" style="margin-top: 12px;"></i>
            </div>
          </div>
          <div id="tambahEviden"></div>
        </div>
        <button type="button" class="action-button previous previous_button">Back</button>
        <a href="#" class="action-button">Finish</a>
      </fieldset>
    </form>
  </section>
  <!-- End Multi step form -->
  <!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/js/intlTelInput.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js'></script>
  <script src="./script.js"></script>

  <script type="text/javascript">
    $(document).ready(function () {
      $('#nama_kegiatan').autocomplete({
        source: "<?php echo site_url('autocomplete/get_nama_kegiatan'); ?>",
        select: function (event, ui) {
          $('[name="nama_kegiatan"]').val(ui.item.label);
        }
      });
      $('#no_ememo').autocomplete({
        source: "<?php echo site_url('autocomplete/get_ememo'); ?>",
        select: function (event, ui) {
          $('[name="no_ememo"]').val(ui.item.label);
        }
      });
      $('#periode_penugasan').autocomplete({
        source: "<?php echo site_url('autocomplete/get_periode_penugasan'); ?>",
        select: function (event, ui) {
          $('[name="periode_penugasan"]').val(ui.item.label);
        }
      });
      $('#nip').autocomplete({
        source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
        select: function (event, ui) {
          $('[name="nip"]').val(ui.item.label);
          $('[name="nama_dosen"]').val(ui.item.name);
          $('[name="jabatan"]').val(ui.item.jabatan);
        }
      });

    });
    var dateToday = new Date();
    $(function () {
      $("#datepicker").datepicker({
        minDate: -49,
        dateFormat: 'dd-mm-yy'
      });
    });
    $(function () {
      $("#datepicker2").datepicker({
        minDate: -49,
        maxDate: 180,
        dateFormat: 'dd-mm-yy'
      });
    });
    $(function () {
      $("#datepicker3").datepicker({
        minDate: -49,
        dateFormat: 'dd-mm-yy'
      });
    });
    $(function () {
      $("#datepicker4").datepicker({
        minDate: -49,
        maxDate: 180,
        dateFormat: 'dd-mm-yy'
      });
    });
    //periode penugasan
    $(function () {
      $("#periode_penugasan").datepicker({
        dateFormat: 'dd M yy'
      });
    });
    $(function () {
      $("#periode_penugasan1").datepicker({
        dateFormat: 'dd M yy'
      });
    });
    //Tambah NIP
    $(document).ready(function () {
      var rowIdx = 0;
      $('#addBtn').on('click', function () {
        $('#tbody').append(`<div id="R${++rowIdx}" >
            
            <div class="show-index" id="showIndex">
                <div class="delete-index" id="remove">
                    <div class="form-group" style="margin-bottom:12px">
                        <div class="row">
                            <div class="col-md-2">
                                <input type="text" name="nip[]" class="autocomplete${rowIdx} form-control custom-form-control " id="nip" required="required" place="nip${rowIdx}">
                                <label style="margin-left:16px">NIP</label>
                            </div>
                            <div class="col-md-3">
                            <input type="text" name="nama_dosen" id="nama${rowIdx}" class=" form-control custom-form-control col-md-11" place="nama${rowIdx}" >
                            <label>Nama</label>
                            </div>
                            <div class="col-md-3">
                            <input type="text" name="jabatan" class=" form-control custom-form-control col-md-11" id="jabatan" place="jabatan${rowIdx}" >
                            <label>Jabatan</label>
                            </div>
                            <div class="col-md-3">
                            <input type="text" name="divisi[]" id="divisi" class="form-control custom-form-control col-md-11"  required="required"autocomplete="off" ><label>Divisi</label>
                            </div>
                            <div class="col-md-1">
                                <i id ="minus" class="fas fa-trash-alt " style="margin-top: 12px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			</div>`)

        $('.autocomplete1').autocomplete({
          source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
          select: function (event, ui) {
            $('[place="nama1" ]').val(ui.item.name);
            $('[place="jabatan1"]').val(ui.item.jabatan);
          }
        });
        $('.autocomplete2').autocomplete({
          source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
          select: function (event, ui) {
            $('[place="nama2" ]').val(ui.item.name);
            $('[place="jabatan2"]').val(ui.item.jabatan);
          }
        });
        $('.autocomplete3').autocomplete({
          source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
          select: function (event, ui) {
            $('[place="nama3" ]').val(ui.item.name);
            $('[place="jabatan3"]').val(ui.item.jabatan);
          }
        });
        $('.autocomplete4').autocomplete({
          source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
          select: function (event, ui) {
            $('[place="nama4" ]').val(ui.item.name);
            $('[place="jabatan4"]').val(ui.item.jabatan);
          }
        });
        $('.autocomplete5').autocomplete({
          source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
          select: function (event, ui) {
            $('[place="nama5" ]').val(ui.item.name);
            $('[place="jabatan5"]').val(ui.item.jabatan);
          }
        });
        $('.autocomplete6').autocomplete({
          source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
          select: function (event, ui) {
            $('[place="nama6" ]').val(ui.item.name);
            $('[place="jabatan6"]').val(ui.item.jabatan);
          }
        });
        $('.autocomplete7').autocomplete({
          source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
          select: function (event, ui) {
            $('[place="nama7" ]').val(ui.item.name);
            $('[place="jabatan7"]').val(ui.item.jabatan);
          }
        });
        $('.autocomplete8').autocomplete({
          source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
          select: function (event, ui) {
            $('[place="nama8" ]').val(ui.item.name);
            $('[place="jabatan8"]').val(ui.item.jabatan);
          }
        });
        $('.autocomplete9').autocomplete({
          source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
          select: function (event, ui) {
            $('[place="nama9" ]').val(ui.item.name);
            $('[place="jabatan9"]').val(ui.item.jabatan);
          }
        });
        $('.autocomplete10').autocomplete({
          source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
          select: function (event, ui) {
            $('[place="nama10" ]').val(ui.item.name);
            $('[place="jabatan10"]').val(ui.item.jabatan);
          }
        });
        $('.autocomplete11').autocomplete({
          source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
          select: function (event, ui) {
            $('[place="nama11" ]').val(ui.item.name);
            $('[place="jabatan11"]').val(ui.item.jabatan);
          }
        });
        $('.autocomplete12').autocomplete({
          source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
          select: function (event, ui) {
            $('[place="nama12" ]').val(ui.item.name);
            $('[place="jabatan12"]').val(ui.item.jabatan);
          }
        });
        $('.autocomplete13').autocomplete({
          source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
          select: function (event, ui) {
            $('[place="nama13" ]').val(ui.item.name);
            $('[place="jabatan13"]').val(ui.item.jabatan);
          }
        });
        $('.autocomplete14').autocomplete({
          source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
          select: function (event, ui) {
            $('[place="nama14" ]').val(ui.item.name);
            $('[place="jabatan14"]').val(ui.item.jabatan);
          }
        });
        $('.autocomplete15').autocomplete({
          source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
          select: function (event, ui) {
            $('[place="nama15" ]').val(ui.item.name);
            $('[place="jabatan15"]').val(ui.item.jabatan);
          }
        });
        $('.autocomplete16').autocomplete({
          source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
          select: function (event, ui) {
            $('[place="nama16" ]').val(ui.item.name);
            $('[place="jabatan16"]').val(ui.item.jabatan);
          }
        });
        $('.autocomplete17').autocomplete({
          source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
          select: function (event, ui) {
            $('[place="nama17" ]').val(ui.item.name);
            $('[place="jabatan17"]').val(ui.item.jabatan);
          }
        });
        $('.autocomplete18').autocomplete({
          source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
          select: function (event, ui) {
            $('[place="nama18" ]').val(ui.item.name);
            $('[place="jabatan18"]').val(ui.item.jabatan);
          }
        });
        $('.autocomplete19').autocomplete({
          source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
          select: function (event, ui) {
            $('[place="nama19" ]').val(ui.item.name);
            $('[place="jabatan19"]').val(ui.item.jabatan);
          }
        });
        $('.autocomplete20').autocomplete({
          source: "<?php echo site_url('/autocomplete/get_nip'); ?>",
          select: function (event, ui) {
            $('[place="nama20" ]').val(ui.item.name);
            $('[place="jabatan20"]').val(ui.item.jabatan);
          }
        });
      });
    });
    $(document).on('click', '#minus', function () {
      var myobj = document.getElementById("remove");
      myobj.remove();
    });

    //addEviden
    $(document).ready(function () {
      $('#addEviden').on('click', function () {
        $('#tambahEviden').append(`
            <div class="form-group" style="margin-bottom:12;" id="removeEviden">
                <div class="row">
                <div class="col-md-11">
                        <input type="file" name="eviden[]" id="eviden" class="form-control" style="padding:13px 16px" value="<?= set_value('eviden[]') ?>">
                        <span id="chk-error"></span>
                        <label style="margin-left:16px"><b>Eviden</b></label>
                    </div>
                    <div class="col-md-1">
                        <i id="hapus" class="fas fa-trash-alt" ></i>
                    </div>
                </div>
            </div>`)
      });
    });
    $(document).on('click', '#hapus', function () {
      var myobj = document.getElementById("removeEviden");
      myobj.remove();
    });
  </script>
  <script>
    jQuery(function () {
      jQuery("#tambahPanitia").hide()
      jQuery("#tambahDivisi").hide()
      jQuery("#kepanitiaan").hide()
      jQuery("#divisi").hide()
      jQuery("#lbldivisi").hide()
      jQuery("#selectformat").hide()
      jQuery("#jenis_pengajuan").change(function () {
        var value = jQuery(this).val();
        if (value == "Kelompok") {
          $("#tambahDivisi").show();
          $("#kepanitiaan").show();
          $("#tambahPanitia").show()
          $("#divisi").show()
          $("#lbldivisi").show()
          $("#selectformat").show()
        } else {
          jQuery("#tambahDivisi").hide()
          jQuery("#tambahPanitia").hide()
          jQuery("#kepanitiaan").hide()
          jQuery("#divisi").hide()
          jQuery("#lbldivisi").hide()
          jQuery("#selectformat").hide()
        }
      });
    });
  </script>
  <script src="https://cdn.tiny.cloud/1/q9tneu2aax9fp91cvqlh7mqvx44p6ph4jb63xq6lax2ybita/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'save autosave preview autolink lists media table print',
      toolbar: 'export table bold italic underline bullist numlist alignleft aligncenter alignright alignjustify fontsizeselect forecolor lineheight h1 h2 h3 h4 h5 h6 ',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      height: '450',

      // he
    });
  </script>
  <script>
    jQuery(function () {
      // jQuery("#jenis_pengajuan").hide()
      jQuery("#jenis_penugasan_kelompok").hide()

      jQuery("#jenis_penugasan_perorangan").hide()
      jQuery("#jenis_pengajuan").change(function () {
        var value = jQuery(this).val();
        if (value == "Perorangan") {
          jQuery("#jenis_penugasan_perorangan").hide()
          $("#jenis_penugasan_perorangan").show();
          jQuery("#penugasan_lainnya_kelompok").hide()
        } else {
          jQuery("#jenis_penugasan_perorangan").hide()
        }
      });
    });
  </script>
  <script>
    jQuery(function () {
      // jQuery("#jenis_pengajuan").hide()
      // jQuery("#penugasan_lainnya_perorangan").hide()
      // jQuery("#penugasan_lainnya_kelompok").hide()
      jQuery("#jenis_penugasan_perorangan").hide()

      jQuery("#jenis_penugasan_kelompok").hide()
      jQuery("#jenis_pengajuan").change(function () {
        var value = jQuery(this).val();
        if (value == "Kelompok") {
          jQuery("#jenis_penugasan_kelompok").hide()
          $("#jenis_penugasan_kelompok").show();
          jQuery("#penugasan_lainnya_perorangan").hide()
        } else {
          jQuery("#jenis_penugasan_kelompok").hide()
        }
      });
    });
  </script>
  <script>
    jQuery(function () {
      jQuery("#penugasan_lainnya_perorangan").hide()
      jQuery("#jenis_penugasan_perorangan").change(function () {
        //  jQuery(this).val() == 'select' ? jQuery("#textarea").hide() : jQuery("#textarea").show();
        var value = jQuery(this).val();
        if (value == "Penugasan Lainnya") {
          jQuery("#penugasan_lainnya_perorangan").hide()
          $("#penugasan_lainnya_perorangan").show();
        } else {
          jQuery("#penugasan_lainnya_perorangan").hide()
        }
      });
    });
  </script>
  <script>
    jQuery(function () {
      jQuery("#penugasan_lainnya_kelompok").hide()
      jQuery("#jenis_penugasan_kelompok").change(function () {
        //  jQuery(this).val() == 'select' ? jQuery("#textarea").hide() : jQuery("#textarea").show();
        var value = jQuery(this).val();
        if (value == "Penugasan Lainnya") {
          jQuery("#penugasan_lainnya_kelompok").hide()
          $("#penugasan_lainnya_kelompok").show();
        } else {
          jQuery("#penugasan_lainnya_kelompok").hide()
        }
      });
    });
  </script>
  <script>
    jQuery(function () {
      // jQuery("#jenis_pengajuan").hide()
      jQuery("#datepicker").hide()
      jQuery("#datepicker2").hide()
      jQuery("#datepicker3").hide()
      jQuery("#datepicker4").hide()
      jQuery("#periode_value").hide()
      jQuery("#lbl_mulai").hide()
      jQuery("#lbl_mulai1").hide()
      jQuery("#lbl_akhir").hide()
      jQuery("#lbl_akhir1").hide()
      jQuery("#jenis_date").change(function () {
        var value = jQuery(this).val();
        if (value == "Custom") {
          $("#periode_value").hide();
          $("#lbl_mulai").show();
          $("#lbl_mulai1").show();
          $("#lbl_akhir").show();
          $("#lbl_akhir1").show();
          $("#datepicker").show();
          $("#datepicker2").show();
          $("#datepicker3").show();
          $("#datepicker4").show();
          // jQuery("#penugasan_lainnya_kelompok").hide()
        } else {
          $("#lbl_mulai").hide();
          $("#datepicker").hide();
          $("#datepicker2").hide();
          $("#datepicker3").hide();
          $("#datepicker4").hide();
          $("#periode_value").show();
        }
      });
    });
  </script>
  <script type="text/javascript">
    const image = document.getElementById('eviden');
    const previewContainer = document.getElementById('imagePreview');
    const previewImage = previewContainer.querySelector(".placeholder-img")
    const previewDefaultText = previewContainer.querySelector(".placeholder-img1")
    image.addEventListener('change', function () {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        previewDefaultText.style.display = 'none';
        previewImage.style.display = "block";
        reader.addEventListener('load', function () {
          previewImage.setAttribute('src', this.result);
        });
        reader.readAsDataURL(file);
      } else {
        previewDefaultText.style.display = null;
        previewImage.style.display = null;
        previewImage.setAttribute('src', "");
      }
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function () {
      $('#prodi').change(function () {
        var id_kategori = $('#prodi').val();
        if (id_kategori != '') {
          $.ajax({
            url: "https://ifik.telkomuniversity.ac.id/karya/fetch",
            method: "POST",
            data: {
              id_kategori: id_kategori
            },
            success: function (data) {
              $('#kategori').html(data);
            }
          })
        }
      });
    });
  </script>
  <script type="text/javascript">
    $("#eviden").change(function () {
      var allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'application/pdf'];
      var file = this.files[0];
      var fileType = file.type;
      if (!allowedTypes.includes(fileType)) {
        jQuery("#chk-error").html('<small class="text-danger">Please choose a valid file (JPEG/JPG/PNG/GIF/PDF)</small>');
        $("#eviden").val('');
        return false;
      } else {
        jQuery("#chk-error").html('');
      }
    });
  </script>

</body>

</html>