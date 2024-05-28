<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Notificacio pagos</title>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 mt-5">
                <div class="card shadow mt-5">
                    <div class="card-header bg-dark"> </div>
                    <div class="card-body">
                        <div>Estimado: <strong> {{ $nombre_cliente }} </strong></div>
                        <hr>
                        <div class="mt-4">
                            <div>
                                <p>
                                    Tu pago por la cantidad de <strong> {{moneda}} - {{monto}} </strong> se ha realizado
                                    correctamente. Agradecemos mucho tu confianza y preferencia.

                                </p>
                                <p>
                                    Si tienes alguna pregunta o necesitas más información, no dudes en contactarnos.
                                </p>

                                <p>
                                    Gracias por preferirnos.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
