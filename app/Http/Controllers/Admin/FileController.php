<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use File;

class FileController extends AdminController
{
    public function getEditFile() {
    	$str = htmlentities(file_get_contents(url('/resources/views/demo.blade.php')));
    	// var_dump($str);exit();

    	return view('admin.File.edit', compact('str'));
    }
}
