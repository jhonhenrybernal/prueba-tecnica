<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pasarela de pago</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
             #detalle-modal{
                width: 80% !important;
              }

               #detalle-mensaje{
                width: 70% !important;
              }
              .timeline {
                position: relative;
                padding: 21px 0px 10px;
                margin-top: 4px;
                margin-bottom: 30px;
            }

            .timeline .line {
                position: absolute;
                width: 4px;
                display: block;
                background: currentColor;
                top: 0px;
                bottom: 0px;
                margin-left: 30px;
            }

            .timeline .separator {
                border-top: 1px solid currentColor;
                padding: 5px;
                padding-left: 40px;
                font-style: italic;
                font-size: .9em;
                margin-left: 30px;
            }

            .timeline .line::before { top: -4px; }
            .timeline .line::after { bottom: -4px; }
            .timeline .line::before,
            .timeline .line::after {
                content: '';
                position: absolute;
                left: -4px;
                width: 12px;
                height: 12px;
                display: block;
                border-radius: 50%;
                background: currentColor;
            }

            .timeline .panel {
                position: relative;
                margin: 10px 0px 21px 70px;
                clear: both;
            }

            .timeline .panel::before {
                position: absolute;
                display: block;
                top: 8px;
                left: -24px;
                content: '';
                width: 0px;
                height: 0px;
                border: inherit;
                border-width: 12px;
                border-top-color: transparent;
                border-bottom-color: transparent;
                border-left-color: transparent;
            }

            .timeline .panel .panel-heading.icon * { font-size: 20px; vertical-align: middle; line-height: 40px; }
            .timeline .panel .panel-heading.icon {
                position: absolute;
                left: -59px;
                display: block;
                width: 40px;
                height: 40px;
                padding: 0px;
                border-radius: 50%;
                text-align: center;
                float: left;
            }

            .timeline .panel-outline {
                border-color: transparent;
                background: transparent;
                box-shadow: none;
            }

            .timeline .panel-outline .panel-body {
                padding: 10px 0px;
            }

            .timeline .panel-outline .panel-heading:not(.icon),
            .timeline .panel-outline .panel-footer {
                display: none;
            }
        </style>

    </head>
    <body>
     <div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h2>Pago básico</h2>
    <p class="lead">Este sistema permitira realizar un pago básico donde debe suministrar los datos necesarios para realizar el pago
(revisar parámetros de entrada del servicio). Debe mantener un registro de la
respuesta generada por el WebService, determinando su estado actual (Aprobado,
pendiente, fallido o rechazado)..</p>
  </div>
    </br>

 <form>


    <div class="col-md-10 order-md-2">
      <h4 class="mb-3">Dirección de Envio</h4>

      <form name="myForm" class="form-horizontal" data-toggle="validator">
        {{ csrf_field() }}
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Nombre de pila</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="" value="{{ old('name') }}" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Apellido</label>
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="{{ old('lastName') }}" value="" required>
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
        </div>
        <div class="row">
           <div class="col-md-6 mb-3">
            <label for="exampleFormControlSelect1">Tipo de documento</label>
            <select class="form-control" id="exampleFormControlSelect1" name="documentType" id="documentType">
              <OPTION>Seleccione</OPTION>
              <option value="CC">CC</option>
               <option value="CE">CE</option>
              <option value="TI">TI</option>
              <option value="RC">RC</option>
              <option value="NIT">NIT</option>
              <option value="RUT">RUT</option>
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Numero de Documento</label>
            <input type="number" class="form-control" id="document" placeholder="Documento" name="document" value="{{ old('document') }}" required>
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="username">Numero Telefonico</label>
          <div class="input-group">
           <input type="number" class="form-control" name="mobile" id="mobile" placeholder="" value="{{ old('surname') }}" required>
            <div class="invalid-feedback" style="width: 100%;">
             Importante usuario.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="username">Nombre de usuario</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">@</span>
            </div>
            <input type="text" class="form-control" name="surname" id="surname" placeholder="Nombre de usuario" value="{{ old('surname') }}" required>
            <div class="invalid-feedback" style="width: 100%;">
             Importante usuario.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label>Correo electrónico </label>
          <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Dirección</label>
          <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" required value="{{ old('address') }}">
          <div class="invalid-feedback">
          </div>
       </div>
        <select class="form-control" id="exampleFormControlSelect1" name="documentType" id="country">
              <OPTION>Seleccione</OPTION>
              <option value="Bogota">Bogota</option>
              <option value="Barranquilla">Barranquilla</option>
              <option value="Bucaramanga">Bucaramanga</option>
               <option value="Cali">Cali</option>
              <option value="Medellin">Medellin</option>
              <option value="Santa marta">Santa marta</option>
            </select>

        <hr class="mb-4">
        <div class="media">
  <img src="{{URL::to('/')}}/imagenes_productos/carro1.jpg" width="350" class="my-4">
  <input type="hidden" name="reference" value="5976030f5575d">
  <br>
  <div class="media-body">
    <h5 class="mt-0">Sail modelos 2013</h5>
    <input type="hidden" name="description" value="Carro sailt 2013" >
    Para una conducción irresistible
El Chevrolet Sail llega para revolucionar el concepto de sedán compacto. Su cómodo y amplio espacio interior, potente motor y excelente consumo de combustible lo hacen diferente.
  </div>
</div>
             <div data-alerts="alerts" data-titles='{"success": "<em>Super!</em>", "error": "<em>Error!</em>"}' data-ids="myid" data-fade="3000"></div>
 <hr class="mb-4">
       <h4 class="mb-3">Pago</h4>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="cc-name">Valor a pagar</label>
            <input type="text" class="form-control" name="total" id="total" placeholder="34.490.000" required value="{{ old('total') }}">
            <small class="text-muted">Este valor esta predeterminado si desea puede cambiar valor</small>
        <div id="load" >
                <div class="alert alert-info" role="alert">
                  Procesando
                </div>
               <i class="fa fa-refresh fa-spin" style="font-size:50px"></i>
            </div>
            <div class="invalid-feedback">
              Name on card is required
            </div>
          </div>
        </div>
               <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block btn-submit " type="submit">Continuar con el pago</button>

      </form>
    </div>
  </div>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2017-2019 Prueba tecnica placetopay </p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="https://dev.placetopay.com/web/">Placetopay</a></li>
    </ul>
  </footer>
</div>



        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

   $(function() {
      $('#load').hide();
  });

</script>
<script type="text/javascript">



    $(".btn-submit").click(function(e){
         $('#load').show();
        e.preventDefault();
        var _token = $("input[name='_token']").val();
        var name = $("input[name=name]").val();
        var lastName = $("input[name=lastName]").val();
        var documentType = $("select[name=documentType]").val();
        var documento = $("input[name=document]").val();
        var surname = $("input[name=surname]").val();
        var email = $("input[name=email]").val();
        var address = $("input[name=address]").val();
        var country = $("input[name=country]").val();
        var reference = $("input[name=reference]").val();
        var description = $("input[name=description]").val();
        var total = $("input[name=total]").val();
        var mobile = $("input[name=mobile]").val();

          if (name == "" || lastName == "" || documentType == "" || documento == "" || surname == "" || email == "" || address == "" || country == "" || reference == "" || description == "" || total == "" || mobile == "") {
            alert("Todo los campos son requeridos");
            return false;
          }



        $.ajax({

           type:'POST',

           url:'/procesar/pago',

           data:{_token:_token,name:name, lastName:lastName, documentType:documentType,documento:documento,surname:surname,email:email,address:address,country:country,reference:reference,description:description,total:total,mobile:mobile},

           success:function(data){
              if(data.result == true){
                window.setTimeout('alert("Los datos fueron enviado  y se redirecionara a placetopay");window.close();', 2000);
              $(document).trigger("add-alerts", [

                  {

                    "message": "Los datos fueron Actualizados se Redirecionara a placetopay.",

                    "priority": 'success'

                  }

                ]);

              setTimeout(function(){window.open(data.url, "Procesar Pago", "width=800, height=600, top=50, left=50", true)},5000);
              $('#load').hide();
              }else{
                $(document).trigger("add-alerts", [

                  {

                    "message": data.mensaje,

                    "priority": 'error'

                  }

                ]);

              }
           }

        });
  });

    function validateForm() {
      var x = document.forms["myForm"]["name"].value;
      if (x == "") {
        alert("Name must be filled out");
        return false;
      }
    }

</script>
    </body>
</html>
