<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use File, Storage, Input;

class FileController extends AdminController
{
    public function getEditFile() {
    	$str = htmlentities(file_get_contents(url('/resources/views/demo.blade.php')));
    	return view('admin.File.edit', compact('str'));
    }
    public function postEditFile(Request $request) {
    	$file = new File;
    	file_put_contents('resources/views/demo.blade.php', $request->editor);
    	// File::delete(url('/resources/views/demo.blade.php'));
    	// Storage::put(url('/resources/views/demo.blade.php'), $request->editor);
    	// var_dump(($request->editor));exit();
    }
}
