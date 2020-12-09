<?php

class Persona extends CI_Controller
{
    public function u() {
        $idPersona = isset($_GET['idPersona'])?$_GET['idPersona']:null;
        
        $this->load->model('pais_model');
        $this->load->model('aficion_model');
        $this->load->model('persona_model');

        $datos['paises'] = $this->pais_model->getAll();
        $datos['aficiones'] = $this->aficion_model->getAll();
        $datos['persona'] = $this->persona_model->getPersonaById($idPersona);
        
        frame($this,'persona/u',$datos);
    }

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

        try {
            $this->persona_model->c($dni,$nombre,$idPais,$idAficiones); //VAMOS POR AQUI
            redirect(base_url().'persona/r');
        }
        catch (Exception $e) {
            prg($e->getMessage(),'persona/c','danger');
        }
        
    }

    public function r() {
        $this->load->model('persona_model');
        $datos['personas'] = $this->persona_model->getAll();
        frame($this,'persona/r',$datos);
      
    }
}