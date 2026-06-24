<?php
class Secciones {
    private $vinculo;
    private $titulo;
    private $inMenu;
    private $ser_administrador;

    public function getVinculo():string
    {   
        return $this -> vinculo;
    }

    public function getTitulo():string
    {   
        return $this -> titulo;
    }

    public function getInMenu():bool
    {   
        return $this -> inMenu;
    }

    public function getSerAdministrador():bool
    {   
        return $this -> ser_administrador;
    }

    private static function buscarDatos(string $ruta): ?array
    {
        $JSON = @file_get_contents($ruta);
        if($JSON === false) { return null; }

        $JSONData = json_decode($JSON);
        if(!is_array($JSONData)) { return null; }

        return $JSONData;
    }    

    public static function secciones_del_sitio():array
    {
        $secciones = [];
        $JSONData = self::buscarDatos('recursos/secciones.json');
        if ($JSONData === null) {
            return $secciones;
        }

        foreach ($JSONData as $value){
            $sec = new self();
            $sec -> vinculo = $value -> vinculo;
            $sec -> titulo = $value -> titulo;
            $sec -> inMenu = $value -> inMenu;
            $sec -> ser_administrador = isset($value -> ser_administrador) ? $value -> ser_administrador : false;
            $secciones[] = $sec;
        }
        return $secciones;
    }

    public static function secciones_menu():array 
    {
        $secciones_validas = [];
        $JSONData = self::buscarDatos('recursos/secciones.json');
        if ($JSONData === null) { return $secciones_validas; }

        foreach ($JSONData as $value) {
            if(isset($value -> inMenu) && $value -> inMenu) { $secciones_validas[] = $value -> vinculo; }
        }

        return $secciones_validas;
    }
}
?>