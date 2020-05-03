<?php 

interface Estrategia{
	function VerGrafica();
}


class GraficaBara implements Estrategia
{
	private $datos;

	function __construct($datos)
	{
		this->$datos = $datos;
	}

	public function VerGrafica()
	{
		echo "<h1> Se genero una grafica en barras. </h1> ";
	}
}

class GraficaLinea implements Estrategia
{
	private $datos;

	function __construct($datos)
	{
		this->$datos = $datos;
	}

	public function VerGrafica()
	{
		echo "<h1> Se genero una grafica en lienas. </h1> ";
	}
}

class GraficaPastel implements Estrategia
{
	private $datos;

	function __construct($datos)
	{
		this->$datos = $datos;
	}

	public function VerGrafica()
	{
		echo "<h1> Se genero una grafica de pastel. </h1> ";
	}
}


class Grafica
{
    private $estrategia;
    private $datos;


    public function __construct($datos)
    {
        $this->datos = $datos;
    }

    public function setEstrategia(Estrategia $estrategia)
    {
        $this->estrategia = $estrategia;
    }

    public function ejecutar()
    {
        $this->estrategia->VerGrafica();
    }
}

$datos = array();
$reporte = new Reporte($datos);
$reporte->setEstrategia(new ReporteBarra($datos));
$reporte->ejecutar();
$reporte->setEstrategia(new ReporteExportacionExcel($datos));
$reporte->ejecutar();
