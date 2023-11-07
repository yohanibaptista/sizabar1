<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'SIZABAR'
        ];
        return view('admin/overview', $data);
    }
}
