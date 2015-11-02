<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Siswa as Siswa;

use Illuminate\Http\Request;

class SiswaController extends Controller {

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
	public function index(Siswa $siswa)
	{
		$siswas = $siswa->get();
		return view('siswa.list',compact('siswas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Siswa $siswa)
	{
		return view('siswa.add',compact('siswa'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $req, Siswa $siswa)
	{
		$siswas = new $siswa;
		$siswas->nama = $req->nama;
		$siswas->jenis_kelamin = $req->jenis_kelamin;
		$siswas->tanggal_lahir =
		date_format(date_create($req->tanggal_lahir),"Y-m-d");
		$siswas->save();
		return redirect('siswa');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Siswa $siswa)
	{
		return view('siswa.detail',compact('siswa'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Siswa $siswa)
	{
		return view('siswa.edit',compact('siswa'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $req, Siswa $siswa)
	{
		$siswa->nama = $req->nama;
		$siswa->jenis_kelamin = $req->jenis_kelamin;
		$siswa->tanggal_lahir =
		date_format(date_create($req->tanggal_lahir),"Y-m-d");
		$siswa->save();
		return redirect('siswa');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Siswa $siswa)
	{
		$siswa->delete();
		return redirect('siswa');
	}

}
