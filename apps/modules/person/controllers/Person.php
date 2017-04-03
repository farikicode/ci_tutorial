<?php

/*
 * ***************************************************************
 * Script : Person.php
 * Version : 
 * Date : Mar 21, 2017
 * Time : 9:55:17 PM
 * Author : Pudyasto Adi W.
 * Email : mr.pudyasto@gmail.com
 * Description : 
 * ***************************************************************
 */

/**
 * Description of Person
 *
 * @author pudyasto
 */
class Person extends CI_Controller {
    //put your code here
    protected $data = "";
    protected $val = "";
    protected $gender = array(
        'Pria' => 'Pria',
        'Wanita' => 'Wanita',
    );


    public function __construct() {
        parent::__construct();
        $this->data = array(
            'msg_main' => "Person",
            'msg_detail' => "Data master person"
        );
        
        $this->load->model("person_qry");
    }
    
    public function index() {
        $this->template
                ->title($this->data['msg_main'], $this->apps->name)
                ->set_layout('main')
                ->build('index', $this->data);
    }
    
    public function add() {
        $this->data['form'] = array(
            'id' => array(
                'id' => 'id',
                'name' => 'id',
                'type' => 'hidden',
                'value' => set_value('id'),
            ),
            'name' => array(
                'id' => 'name',
                'name' => 'name',
                'type' => 'text',
                'value' => set_value('name'),
                'placeholder' => 'Masukkan Nama Lengkap',
                'class' => 'form-control',
            ),
            'address' => array(
                'id' => 'address',
                'name' => 'address',
                'type' => 'text',
                'value' => set_value('address'),
                'placeholder' => 'Masukkan Alamat',
                'class' => 'form-control',
                'style' => 'resize: vertical; height: 80px;'
            ),
            'gender' => array(
                'attr' => array(
                    'id' => 'gender',
                    'class' => 'form-control',
                ),
                'name' => 'gender',
                'value' => set_value('gender'),
                'data' => $this->gender,
            ),
            'phone' => array(
                'id' => 'phone',
                'name' => 'phone',
                'type' => 'text',
                'value' => set_value('phone'),
                'placeholder' => 'Masukkan No. Telp',
                'class' => 'form-control',
            ),
            'email' => array(
                'id' => 'email',
                'name' => 'email',
                'type' => 'email',
                'value' => set_value('email'),
                'placeholder' => 'Masukkan Email',
                'class' => 'form-control',
            ),
            'birthdate' => array(
                'id' => 'birthdate',
                'name' => 'birthdate',
                'type' => 'birthdate',
                'value' => set_value('birthdate'),
                'placeholder' => 'Masukkan Tanggal Lahir',
                'class' => 'form-control',
            ),
            
        );
        
        $this->template
                ->title($this->data['msg_main'], $this->apps->name)
                ->set_layout('main')
                ->build('form', $this->data);
    }
    
    public function json_dgview() {
        echo $this->person_qry->json_dgview();
    }
    
    public function submit() {
        $res = $this->person_qry->submit();
    }
}
