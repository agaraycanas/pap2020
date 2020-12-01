<?php

class Persona extends CI_Controller
{

    public function c()
    {
        $this->load->model('pais_model');
        $this->load->model('aficion_model');
        $datos['paises'] = $this->pais_model->getAll();
        $datos['aficiones'] = $this->aficion_model->getAll();
        frame($this,'persona/cGet',$datos);
    }

    public function cPost()
    {
        
        $dni = (isset($_POST['dni']) && $_POST['dni'] != '') ? $_POST['dni'] : null;
        $nombre = (isset($_POST['nombre']) && $_POST['nombre'] != '') ? $_POST['nombre'] : null;
        $idPais= (isset($_POST['idPais']) && $_POST['idPais'] != '') ? $_POST['idPais'] : null;
        $idAficiones = (isset($_POST['idAficiones']) && $_POST['idAficiones'] != '') ? $_POST['idAficiones'] : [];
        
        $this->load->model('persona_model');

        if ($nombre != null && $dni!= null && $idPais != null) {

            if ($this->persona_model->getPersona($dni)==null) {
                $this->persona_model->c($dni,$nombre,$idPais,$idAficiones); //VAMOS POR AQUI
                $this->load->view('pais/paisCOK');
            }
            else {
                frame($this,'pais/paisCErrorPaisDuplicado');
            }
        }
        else {
            frame($this,'pais/paisCErrorPaisVacio');
        }
        
    }

    public function r() {
        //$this->load->model('pais_model');
        //$datos['paises'] = $this->pais_model->getAll();
        frame($this,'persona/r');
      
    }
}