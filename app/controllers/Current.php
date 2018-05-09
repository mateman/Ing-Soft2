<?php


class Current extends Controller {

    public function index() {
        $datos = [
            'title' => 'Bienvenido al mvc'
        ];
        $this->view('pages/index', $datos);
    }
 
 
    public function update($id=1) {
        echo "Current update: " . $id;
    }
}