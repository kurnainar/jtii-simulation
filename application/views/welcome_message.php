<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Calculator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <style>
    th {
      text-align: center;
    }

    .tengah {
      text-align: center;
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
  <script>var site_url = '<?php echo site_url() ?>';</script>
</head>
<body>

<div class="container">
  <h2 style="margin-bottom: 3%; text-align: center;">Kalkulator Deposito</h2>
  <form autocomplete="off" id="formCalculate">
    <!-- <div class="form-group">
      <label class="control-label col-sm-2" for="nama">Nama:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="nama" placeholder="Masukkan nama" name="nama" required>
      </div>
    </div>
    
	<div class="form-group">
      <label class="control-label col-sm-2" for="nominal1">Nominal Deposito Awal:</label>
      <div class="col-sm-10">          
        <input type="number" class="form-control" id="nominal1" placeholder="Masukkan Deposito Awal" name="nominal1" required>
      </div>
    </div>

	<div class="form-group">
      <label class="control-label col-sm-2" for="tgl1">Tanggal Deposito Awal:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control tanggal" id="tgl1" placeholder="Masukkan Deposito Awal" name="tgl1" required>
      </div>
    </div>

	<div class="form-group">
      <label class="control-label col-sm-2" for="tgl2">Tanggal Pengambilan Deposito:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control tanggal" id="tgl2" placeholder="Masukkan Deposito Awal" name="tgl2" required>
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-5">
        <button type="button" class="btn btn-success btn-block">Hitung</button>
      </div>
    </div> -->

    <div class="row">
      <div class="col-sm-3">
        <div class="form-group">
          <label for="nama">Nama:</label>
          <input type="text" class="form-control" id="nama" placeholder="Masukkan nama" name="nama" autofocus>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <label for="nominal1">Nominal Deposito Awal:</label>
          <input type="number" class="form-control" id="nominal1" placeholder="Masukkan Deposito Awal" name="nominal1">
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <label for="tgl1">Tanggal Deposito Awal:</label>
          <input type="text" class="form-control tanggal" id="tgl1" placeholder="Masukkan Deposito Awal" name="tgl1">
        </div>
      </div>

      <div class="col-sm-3">
        <div class="form-group">
          <label for="tgl2">Tanggal Pengambilan Deposito:</label>
          <input type="text" class="form-control tanggal" id="tgl2" placeholder="Masukkan Deposito Awal" name="tgl2">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6">
        <button type="button" class="btn btn-success btn-block" id="hitung">Hitung</button>
      </div>

      <div class="col-sm-6">
        <button type="reset" class="btn btn-danger btn-block" id="reset" onclick="clearTable()">Reset</button>
      </div>
    </div>
  </form>
  
  <div id="result" style="margin-top: 5%;">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Nominal Awal Deposito</th>
          <th>Tanggal Deposito</th>
          <th>Tanggal Pengambilan Deposito</th>
          <th>Bunga (%)</th>
          <th>Total Deposito</th>
        </tr>
      </thead>
      <tbody id="show-response"></tbody>
    </table>
  </div>
</div>

<script>
	$(document).ready(function(){
		$( ".tanggal" ).datepicker();
    document.getElementById("result").style.display = "none";

		$("button#hitung").click(function(){
			Validasi();
		});

    $("button#hitung").click(function(){
			document.getElementById("result").style.display = "none";
		});

    function Validasi()
		{
      var nama = $("#nama").val();
			var nominal1 = $("#nominal1").val();
			var tgl1 = $("#tgl1").val();
			var tgl2 = $("#tgl2").val();

      if( nama === '' ) {
        alert('Nama tidak boleh kosong');
        document.getElementById('nama').focus();
      } else if(nominal1 === '') {
        alert('Nominal deposito awal tidak boleh kosong');
        document.getElementById('nominal1').focus();
      } else if(tgl1 === '') {
        alert('Tanggal deposito awal tidak boleh kosong');
        document.getElementById('tgl1').focus();
      } else if(tgl2 === '') {
        alert('Tanggal pengambilan deposito tidak boleh kosong');
        document.getElementById('tgl2').focus();
      } else {
        Response();
      }
		}

    function Response()
    {
      $.ajax({
        url : site_url + 'Welcome/process',
        type: "POST",
        data: $("#formCalculate").serialize(),
        dataType: "JSON",
        success: function(data)
        {
          document.getElementById("result").style.display = "block";
          table(data);
        }
      });
    }

    function table(params)
    {
      var html = '';
      html += '<tr>'+
              '<td>'+params.result.nama+'.</td>'+
              '<td class="tengah">Rp. '+params.result.nominal+'</td>'+
              '<td class="tengah">'+params.result.tgldeposito+'</td>'+
              '<td class="tengah">'+params.result.tglambil+'</td>'+
              '<td class="tengah">'+params.result.bunga+'</td>'+
              '<td class="tengah">Rp. '+params.result.hasil+'</td>'+
            '</tr>';
      $('#show-response').html(html);
    }
	});

  function clearTable()
  {
    document.getElementById('result').style.display = 'none';
    document.getElementById('nama').focus();
  }
</script>

</body>
</html>