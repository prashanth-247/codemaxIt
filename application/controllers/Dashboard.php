<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent:: __construct();
        $this->load->model('ManufacturerModel');

    }

    public function index()
    {
        $data['page'] = "dashboard";
        $data['manufacturerData'] = $this->ManufacturerModel->getallManufacturers();
        $this->load->view('dashboard', $data);
    }

    public function addManufacturer()
    {
        echo $this->ManufacturerModel->addManufacturer();
    }

    public function deleteManufacturer($manufacturerId)
    {
        echo $this->ManufacturerModel->deleteManufacturer($manufacturerId);
    }

    public function addModel()
    {
        $data['page'] = "add-model";
        $data['manufacturerData'] = $this->ManufacturerModel->getallManufacturers();
        $this->load->view('add-model', $data);
    }

    public function upload()
    {
        $targetDir = "./assets/uploads/";
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        $images_arr = array();
        foreach ($_FILES['files']['name'] as $key => $val) {
            $image_name = $_FILES['files']['name'][$key];
            $tmp_name = $_FILES['files']['tmp_name'][$key];
            $size = $_FILES['files']['size'][$key];
            $type = $_FILES['files']['type'][$key];
            $error = $_FILES['files']['error'][$key];

            // File upload path
            $fileName = basename($_FILES['files']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;

            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                // Store images on the server
                if (move_uploaded_file($_FILES['files']['tmp_name'][$key], $targetFilePath)) {
                    $images_arr[] = $fileName;
                }
            }
        }
        if (count($images_arr) > 0) {
            echo json_encode($images_arr);
        } else {
            echo "fail";
        }


    }

    public function addNewModel()
    {
        echo $this->ManufacturerModel->addNewModel();
    }

    public function modelList()
    {
        $data['page'] = "models-list";
        $data['modelsData'] = $this->ManufacturerModel->getAllModels();
        $this->load->view('models-list', $data);
    }

    public function getModaldataById($modalId)
    {
        echo $this->ManufacturerModel->getModaldataById($modalId);
    }

    public function getModalImagesById($modalId)
    {
        echo $this->ManufacturerModel->getModalImagesById($modalId);
    }

    public function deleteModel($modalId)
    {
        echo $this->ManufacturerModel->deleteModel($modalId);
    }

}
