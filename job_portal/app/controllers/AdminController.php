<?php
require_once 'app/models/EmployerModel.php';

class AdminController {
    public function index() {
        $employerModel = new EmployerModel();
        $employers = $employerModel->getAll();
        require 'app/views/employers/list.php';
    }

    public function create() {
        require 'app/views/employers/form.php';
    }

    public function store() {
        $data = $_POST;
        $employerModel = new EmployerModel();
        $employerModel->insert($data);
        header('Location: /?controller=Admin&action=index');
    }

    public function edit($id) {
        $employerModel = new EmployerModel();
        $employer = $employerModel->getById($id);
        require 'app/views/employers/form.php';
    }

    public function update($id) {
        $data = $_POST;
        $employerModel = new EmployerModel();
        $employerModel->update($id, $data);
        header('Location: /?controller=Admin&action=index');
    }

    public function delete($id) {
        $employerModel = new EmployerModel();
        $employerModel->delete($id);
        header('Location: /?controller=Admin&action=index');
    }

    public function search() {
        $keyword = $_GET['keyword'];
        $employerModel = new EmployerModel();
        $employers = $employerModel->search($keyword);
        require 'app/views/employers/list.php';
    }
}
