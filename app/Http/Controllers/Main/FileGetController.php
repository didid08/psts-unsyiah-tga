<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\Validator;

class FileGetController extends Controller
{
    public function __invoke ($filename)
    {
        return response()->file(storage_path().'/app/data/'.$filename);
    }
}
