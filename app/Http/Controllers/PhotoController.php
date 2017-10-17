<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;

use App\Http\Requests;

use App\Photo;

class PhotoController extends Controller
{

   protected $redirectTo = '/home';

	public function __construct ()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		return view('upload.index');
	}

	public function store(Request $request)
	{

		$url = $request->file('photo')->store('photos');
		$user = $request->user();
	
		Photo::create([
			'user_id' => $user->id,
			'description' => $request->description,
			'url' => $url
		]);

		return redirect('home');
	}

	
}
