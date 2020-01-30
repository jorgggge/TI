<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Evidencias de {{$prueba}}</title>
</head>
<body>
    Hola {{$usuario}}, estos son los resultados de tu prueba {{$prueba}}.

    <p>Las evidencias de los siguientes atributos han sido aprobadas, enhorabuena.</p>

    <ul>
    <?php
    foreach ($aprobadas as $aprobada)
    {
        ?> <li>  <?php
        echo $aprobada;
        ?> </li> <?php
    }
    ?>
    </ul>

    Te recomendamos revisar las evidencias de los siguientes atributos, ya que no han sido aprobadas o bien, no las has ingresado aún.

    <ul>
        <?php
        foreach ($incorrectas as $incorrecta)
        {
        ?> <li>  <?php
            echo $incorrecta;
            ?> </li> <?php
        }
        ?>
    </ul>

    Que tengas un buen día.
</body>
</html>
