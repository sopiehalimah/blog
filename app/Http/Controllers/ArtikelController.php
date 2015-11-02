<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Posts;
use Auth;
use Illuminate\Support\Facades\Input;

class ArtikelController extends Controller {


	
	public function __construct()
	{
		$this->middleware('auth');//akan menjalankan function dalam class apabila sudah login
									//apabila belum aka dijalankan dihalaman login
		// $this->middleware('guest');//tidak ada pengecekan login
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = array('data'=>Posts::all());
		return view('artikel.all')->with($data);
	}

	public function komentar()
	{
		$komen = new \App\Komentar;
		$komen->idposts = Input::get('idpost');
		$komen->isi = Input::get('isi');
		$komen->idpengguna = Auth::user()->id;
		$komen->save();
		echo "Sukses";
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('artikel.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$post = new Posts;
		$post->idpengguna = Auth::user()->id;
		$post->judul = Input::get('judul');
		$post->isi = Input::get('isi');
		$post->tag = Input::get('tag');
		$post->slug = str_slug(Input::get('judul'));

		if(Input::hasFile('sampul')){
			$sampul = date('YmdHis')
			.uniqid()
			."."
			.Input::file('sampul')->getClientOriginalExtension();

			Input::file('sampul')->move(storage_path(),$sampul);
			$post->sampul = $sampul;

		}
		$post->save();

		return redirect(url('artikel'));

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$data = array('data'=>Posts::where('slug',$slug)->first());
			return view('artikel.show')->with($data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = array('data'=>Posts::find($id));

		//dd($data);

		return view('artikel.edit')->with($data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$post = Posts::find(Input::get('id'));
		$post->idpengguna = 1;
		$post->judul = Input::get('judul');
		$post->isi = Input::get('isi');
		$post->tag = Input::get('tag');
		$post->slug = str_slug(Input::get('judul'));

		if(Input::hasFile('sampul')){
			$sampul = date('YmdHis')
			.uniqid()
			."."
			.Input::file('sampul')->getClientOriginalExtension();

			Input::file('sampul')->move(storage_path(),$sampul);
			$post->sampul = $sampul;

		}
		$post->save();

		return redirect(url('artikel'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Posts::find($id)->delete();
		return redirect(url('artikel'));
	}

}
