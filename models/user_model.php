<?php

class User_Model extends Model {
    function __construct() {
        parent::__construct();
    }

    function userList() {
        $sth = $this->db->prepare('SELECT id, login, role FROM users');
        $sth->execute();
        return $sth->fetchAll();
    }

    function userSingleList($id) {
        $sth = $this->db->prepare('SELECT id, login, role FROM users WHERE id = :id');
        $sth->execute(array(':id' => $id));
        return $sth->fetch();
    }

    function create($data) {
        $postData = array(
            'login' => $data['login'],
            'password' => Hash::create('sha256', $data['password'], HASH_PASSWORD_KEY),
            'role' => $data['role']
        );
        $this->db->insert('users', $postData);
    }

    function editSave($data) {

        $postData = array(
            'id' => $data['id'],
            'login' => $data['login'],
            'password' => Hash::create('sha256', $data['password'], HASH_PASSWORD_KEY),
            'role' => $data['role']
        );

        $this->db->update('users', $postData, "`id` = {$data['id']}");
    }

    function delete($id) {
        $sth = $this->db->prepare('SELECT role FROM users WHERE id = :id ');
        $sth->execute(array(':id' => $id));
        $data = $sth->fetch();
        if($data['role'] == 'owner'){
            return false;
        }

        $sth = $this->db->prepare('DELETE FROM users WHERE id = :id ');
        $sth->execute(array(':id' => $id));
    }
}