<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class ManufacturerModel extends CI_Model
{

    function __construct() //default constructor
    {
        parent::__construct();
        $this->load->database();

    }

    public function getallManufacturers()
    {
        $getManufacturersQry = $this->db->select('manufacturer_id,manufacturer')
            ->from('manufacturer')
            ->where('log_active ', 1)
            ->where('log_state <', 3)
            ->get();
        return $getManufacturersQry->result_array();

    }

    public
    function checkManufacturerNameExist()
    {
        $getNameQry = $this->db->select('*')
            ->from('manufacturer')
            ->where('manufacturer', $this->input->post('manufacturer'))
            ->get();

        if ($getNameQry->num_rows() > 0) {
            return 'exists';
        } else {
            return 'fail';
        }

    }

    public function addManufacturer()
    {
        $check = $this->checkManufacturerNameExist();
        if ($check == "exists") {
            return "manufacturer_exists";
        } else {
            $addArray = array(
                'manufacturer' => $this->input->post('manufacturer'),
                'log_datetime' => date('Y-m-d H:i:s')
            );
            $this->db->insert('manufacturer', $addArray);
            return "success";
        }

    }

    public function deleteManufacturer($manufacturerId)
    {
        $delArray = array('log_state' => 3,
            'log_datetime' => date('Y-m-d H:i:s')
        );

        $this->db->where('manufacturer_id', $manufacturerId)
            ->update('manufacturer', $delArray);
        return "success";
    }

    public function addNewModel()
    {
        $addArray = array(
            'manufacturer_id' => $this->input->post('manufacturer_id'),
            'model' => $this->input->post('model'),
            'color' => $this->input->post('color'),
            'manufacturing_year' => $this->input->post('manufacturing_year'),
            'registration_number' => $this->input->post('registration_number'),
            'note' => $this->input->post('note'),
            'log_datetime' => date('Y-m-d H:i:s')
        );
        $this->db->insert('model', $addArray);

        $modelId = $this->db->insert_id();

        $temp = $this->input->post('images');
        $imagesArray = explode(',', $temp);

        for ($i = 0; $i < count($imagesArray); $i++) {
            $imagesInsertArray = array(
                'model_id' => $modelId,
                'image' => trim($imagesArray[$i], '"'),
                'log_datetime' => date('Y-m-d H:i:s')
            );
            // return $imagesArray[$i];
            $this->db->insert('images', $imagesInsertArray);
        }

        return "success";
    }

    public function getAllModels()
    {
        $getModelsQry = $this->db->select('mod.*,man.manufacturer')
            ->from('model mod')
            ->join('manufacturer man', 'man.manufacturer_id=mod.manufacturer_id', 'inner')
            ->where('mod.log_state < ', 3)
            ->where('mod.log_active', 1)
            ->get();
        return $getModelsQry->result_array();
    }

    public function getModaldataById($modalId)
    {
        $getModelsQry = $this->db->select('mod.*,man.manufacturer')
            ->from('model mod')
            ->join('manufacturer man', 'man.manufacturer_id=mod.manufacturer_id', 'inner')
            ->where('mod.model_id', $modalId)
            ->get();
        return json_encode($getModelsQry->result_array());
    }

    public function getModalImagesById($modalId)
    {
        $getModelsImgsQry = $this->db->select('image,image_id')
            ->from('images')
            ->where('model_id', $modalId)
            ->get();
        return json_encode($getModelsImgsQry->result_array());
    }

    public function deleteModel($modalId)
    {
        $delArray = array('log_state' => 3,
            'log_datetime' => date('Y-m-d H:i:s')
        );

        $this->db->where('model_id', $modalId)
            ->update('model', $delArray);
        return "success";
    }

}
