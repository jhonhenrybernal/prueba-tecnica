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
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
            </br>
             @if (\Session::has('error'))
                <div class="alert alert-danger">
                    <ul>
                        <li>{!! \Session::get('error') !!}</li>
                    </ul>
                </div>
            @endif
           </br>


  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Informacion del Pago realizado</span>
        <span class="badge badge-secondary badge-pill">3</span>
      </h4>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">Nombre del producto</h6>
            <small class="text-muted">Breve descripción</small>
          </div>
          <span class="text-muted">$12</span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">Segundo producto</h6>
            <small class="text-muted">Breve descripción</small>
          </div>
          <span class="text-muted">$8</span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">Tercer artículo</h6>
            <small class="text-muted">Breve descripción</small>
          </div>
          <span class="text-muted">$5</span>
        </li>
        <li class="list-group-item d-flex justify-content-between bg-light">
          <div class="text-success">
            <h6 class="my-0">Código promocional</h6>
            <small>Ejemplo de código</small>
          </div>
          <span class="text-success">-$5</span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (CO)</span>
          <strong>$20</strong>
        </li>
      </ul>
    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Dirección de Envio</h4>
      <form class="needs-validation" action="{{ route('process.makePayment') }}" method="POST" novalidate>
        {{ csrf_field() }}
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Nombre de pila</label>
            <input type="text" class="form-control" name="name" placeholder="" value="{{ old('name') }}" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Apellido</label>
            <input type="text" class="form-control" id="lastName" placeholder="{{ old('lastName') }}" value="" required>
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="username">Nombre de usuario</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">@</span>
            </div>
            <input type="text" class="form-control" name="surname" placeholder="Nombre de usuario" value="{{ old('surname') }}" required>
            <div class="invalid-feedback" style="width: 100%;">
              Your username is required.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="email">Correo electrónico </label>
          <input type="email" class="form-control" name="email" placeholder="you@example.com" value="{{ old('email') }}">
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Dirección</label>
          <input type="text" class="form-control" name="address" placeholder="1234 Main St" required value="{{ old('address') }}">
          <div class="invalid-feedback">
          </div>
       </div>
        <div class="mb-3">
          <label for="address">Pais</label>
          <input type="text" class="form-control" name="city" placeholder="1234 Main St" required value="{{ old('city') }}">
          <div class="invalid-feedback">
          </div>
       </div>
        <div class="mb-3">
          <label for="address">Ciudad</label>
          <input type="text" class="form-control" name="country" placeholder="1234 Main St" required value="{{ old('country') }}">
          <div class="invalid-feedback">
          </div>
       </div>

        <hr class="mb-4">
        <div class="media">
  <img src="{{URL::to('/')}}/imagenes_productos/carro1.jpg" class="mr-3" alt="...">
  <input type="hidden" name="reference" value="5976030f5575d">
  <div class="media-body">
    <h5 class="mt-0">Sail modelos 2013</h5>
    Para una conducción irresistible
El Chevrolet Sail llega para revolucionar el concepto de sedán compacto. Su cómodo y amplio espacio interior, potente motor y excelente consumo de combustible lo hacen diferente.
  </div>
</div>
 <hr class="mb-4">
       <h4 class="mb-3">Pago</h4>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="cc-name">Valor a pagar</label>
            <input type="text" class="form-control" name="total" placeholder="34.490.000" required value="{{ old('total') }}">
            <small class="text-muted">Este valor esta predeterminado si desea puede cambiar valor</small>
            <div class="invalid-feedback">
              Name on card is required
            </div>
          </div>
        </div>
               <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Continuar con el pago</button>
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
    </body>
</html>
