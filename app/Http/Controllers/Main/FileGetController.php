<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\Validator;

class FileGetController extends Controller
{
    public function __invoke ($filename)
    {
        return response()->file(storage_path().'/app/data/'.$filename);
    }

    /*public function zip ($filename, $filetoadd)
    {
    	if (Storage::exists('data/pub/'.$filename)) {
    		return response()->file(storage_path().'/app/data/pub/'.$filename);
    	}

    	$filename = storage_path().'/app/data/pub/'.$filename;
    	$filetoadd = explode('|', $filetoadd);

    	$zip = Zip::create($filename);

    	foreach ($filetoadd as $index => $value) {
    		$zip->add(storage_path().'/app/data/'.$value);
    	}
    	$zip->close();

    	return response()->file($filename);
    }*/
}
