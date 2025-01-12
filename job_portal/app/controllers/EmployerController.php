<?php
require_once 'app/models/Employer.php';

class EmployerController {
    public function index() {
        $employerModel = new Employer();
        $employers = $employerModel->getAll();
        require_once 'app/views/employers/index.php';
    }

    public function create() {
        require_once 'app/views/employers/create.php';
    }

    public function store() {
        $employerModel = new Employer();
        $employerModel->create($_POST);
        header('Location: /');
    }

    public function edit($id) {
        $employerModel = new Employer();
        $employer = $employerModel->find($id);
        require_once 'app/views/employers/edit.php';
    }

    public function update($id) {
        $employerModel = new Employer();
        $employerModel->update($id, $_POST);
        header('Location: /');
    }

    public function delete($id) {
        $employerModel = new Employer();
        $employerModel->delete($id);
        header('Location: /');
    }
}