<?php

class User extends Controller {
    function __construct() {
        parent::__construct();
        Session::init();
        $logged = Session::get('loggedIn');
        $role = Session::get('role');

        if ($logged == false || $role != 'owner') {
            Session::destroy();
            header('location: login');
            exit;
        }

    }

    function index() {
        $this->view->title = 'User Page';
        $this->view->userList = $this->model->userList();
        $this->view->render('header');
        $this->view->render('user/index');
        $this->view->render('footer');
    }

    function create() {
        $data = array();
        $data['login'] = $_POST['login'];
        $data['password'] = $_POST['password'];
        $data['role'] = $_POST['role'];

        //@TODO: Do your error checking!!

        $this->model->create($data);
        header('location: ' . URL . 'user');
    }

    function edit($id) {
        $this->view->title = 'Edit User';
        $this->view->user = $this->model->userSingleList($id);
        $this->view->render('header');
        $this->view->render('user/edit');
        $this->view->render('footer');
    }

    function editSave($id) {
        $data = array();
        $data['id'] = $id;
        $data['login'] = $_POST['login'];
        $data['password'] = $_POST['password'];
        $data['role'] = $_POST['role'];

        $this->model->editSave($data);

        header('location: ' . URL . 'user');
    }

    function delete($id) {
        $this->model->delete($id);
        header('location: ' . URL . 'user');
    }
}