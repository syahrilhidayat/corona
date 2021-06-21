<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Pantau Penyebaran Corona</title>
  </head>
  <body>

    <div class="jumbotron jumbotron-fluid bg-dark text-dark">
      <div class="container text-center">
        <h1 class="display-4">Virus Corona</h1>
        <p class="lead">
          <h2>Pantau Penyebaran Virus Corona DiIndonesia
            <br> Secara Realtime
          </h2>
        </p>
      </div>
    </div>

    <style type="text/css">
      .box{
        padding: 30px 40px;
        border-radius: 8px;
      }
    </style>
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-2">
          <div class="bg-danger box text-white">
            <div class="row"> 
              <div class="col-md-6">
                <h5>Positif</h5>
                <h2 id="data-kasus">100</h2>
                <h5>orang</h5>
              </div>
              <div class="col-md-4">
                <img src="img/sad.svg" style="width:95px;">
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-2">
          <div class="bg-warning box text-white">
            <div class="row"> 
              <div class="col-md-6 mb-2">
                <h5>Meninggal</h5>
                <h2 id="data-mati">100</h2>
                <h5>orang</h5>
              </div>
              <div class="col-md-4">
                <img src="img/cry.svg" style="width:95px;">
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="bg-success box text-white">
            <div class="row"> 
              <div class="col-md-6">
                <h5>Sembuh</h5>
                <h2 id="data-sembuh">100</h2>
                <h5>orang</h5>
              </div>
              <div class="col-md-4">
                <img src="img/happy.svg" style="width:95px;">
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12 mt-3">
          <div class="bg-primary box text-white">
            <div class="row"> 
              <div class="col-md-4">
                <h2>INDONESIA</h2>
                <h5 id="data-id">Positif : 10 orang <br> Meninggal : 20 orang <br> Sembuh : 50 orang </h5>
              </div>
              <div class="col-md-4">
                <img src="img/indonesia.svg" style="width:150px;">
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="card mt-3">
        <div class="card-header bg-dark text-white">
          <b>Data Kasus Corona Di Indonesia</b>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Provinsi</th>
                <th>Positif</th>
                <th>Sembuh</th>
                <th>Meninggal</th>
              </tr>
            </thead>
            <tbody id="table-data">
              
            </tbody>
          </table>

          </div>
      </div>

    </div>



    <footer class="bg-dark text-white text-center mt-3 pt-2 pb-2">
      Created&copy;Syahril Hidayat
    </footer>

    
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  </body>
</html>

<script type="text/javascript">
  $(document).ready(function(){

    //memanggil fungsi function all data
    semuaData();
    dataNegara();
    dataProvinsi();

    //untuk membuat auto refresh / realtime
    setInterval(function(){
      semuaData();
      dataNegara();
      dataProvinsi();
    }, 3000);

    function semuaData(){
      $.ajax({
        url : 'https://coronavirus-19-api.herokuapp.com/all',
        success : function(data){
          try{
            var json = data;
            var kasus = data.cases;
            var meninggal = data.deaths;
            var sembuh = data.recovered;

            $('#data-kasus').html(kasus);
            $('#data-mati').html(meninggal);
            $('#data-sembuh').html(sembuh);

          }catch{
            alert('Error');
          }
        }
      });
    }

    function dataNegara(){
     $.ajax({
        url : 'https://coronavirus-19-api.herokuapp.com/countries',
        success : function(data){
          try{
            var json = data;
            var html = [];

            if(json.length > 0){
              var i;
              for(i = 0; i < json.length; i++){
                var dataNegara = json[i];
                var namaNegara = dataNegara.country;

                if(namaNegara === 'Indonesia'){
                  var kasus = dataNegara.cases;
                  var mati = dataNegara.deaths;
                  var sembuh = dataNegara.recovered;
                  $('#data-id').html(
                      'Positif : '+kasus+' orang <br> Meninggal : '+mati+' orang <br> Sembuh : '+sembuh+' orang'
                    )
                }
              }
            }

          }catch{
            alert('Error');
          }
        }
      }); 
    }

    function dataProvinsi(){
      $.ajax({
        url : 'curl.php',
        type: 'GET',
        success : function(data){
          try{
            $('#table-data').html(data);

          }catch{
            alert('Error');
          }
        }
      });
    }

    

  });
</script>