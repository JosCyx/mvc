<?php
//autor:Miño Figueroa Bryan
class citasDto
{
    private $id;
    private $duenio;
    private $nmascotas;
    private $edad;
    private $celular;
    private $fecha;

    public function getid()
    {
        return $this->id;
    }

    public function setid($id)
    {
        $this->id = $id;
    }

    public function getduenio()
    {
        return $this->duenio;
    }

    public function setduenio($duenio)
    {
        $this->duenio = $duenio;
    }

    public function getnmascotas()
    {
        return $this->nmascotas;
    }

    public function setnmascotas($nmascotas)
    {
        $this->nmascotas = $nmascotas;
    }

    public function getedad()
    {
        return $this->edad;
    }

    public function setedad($edad)
    {
        $this->edad = $edad;
    }

    public function getcelular()
    {
        return $this->celular;
    }

    public function setcelular($celular)
    {
        $this->celular = $celular;
    }


    public function getfecha()
    {
        return $this->fecha;
    }

    public function setfecha($fecha)
    {
        $this->fecha = $fecha;
    }
}
?>