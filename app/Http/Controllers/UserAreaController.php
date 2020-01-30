<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;

class UserAreaController extends Controller
{
		public function index()
	    {
	    	Test::Test(1);
	    }    
}
