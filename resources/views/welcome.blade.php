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
            <input type="text" class="form-control" name="name" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Apellido</label>
            <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
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
            <input type="text" class="form-control" name="surname" placeholder="Nombre de usuario" required>
            <div class="invalid-feedback" style="width: 100%;">
              Your username is required.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="email">Correo electrónico </label>
          <input type="email" class="form-control" name="email" placeholder="you@example.com">
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Dirección</label>
          <input type="text" class="form-control" name="address" placeholder="1234 Main St" required>
          <div class="invalid-feedback">
          </div>
       </div>

        <hr class="mb-4">
        <div class="media">
  <img src="data:image/jpeg;base64,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" class="mr-3" alt="...">
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
            <input type="text" class="form-control" name="total" placeholder="34.490.000" required>
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
