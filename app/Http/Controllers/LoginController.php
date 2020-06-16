<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Korisnik;
use Illuminate\Support\Facades\File;

class LoginController extends Controller {
	
	public function login(Request $request){
		$request->validate([
			'tbKorisnickoIme' => 'required|alpha',
			'tbLozinka' => 'required'		
		]);

		$korisnickoIme = $request->get('tbKorisnickoIme');
		$lozinka = $request->get('tbLozinka');

		$korisnik = new Korisnik();
		$korisnik->korisnicko_ime = $korisnickoIme;
		$korisnik->lozinka = $lozinka;

		$loginKorisnik = $korisnik->getByUsernameAndPassword();

		if(!empty($loginKorisnik)){
			$request->session()->push('user', $loginKorisnik);
			\Log::info('Uspesno je ulogovan: '.$korisnik->korisnicko_ime ." ".date("Y-m-d H:i:s"));

			return redirect()->back()->with('success','Uspesno ste se ulogovali!');

		}
		return redirect()->back()->with('error','Niste registrovani!');
	}

	public function logout(Request $request){
        \Log::info('Uspesno je izlogovan: '.$request->session()->get('user')[0]->korisnicko_ime ." ".date("Y-m-d H:i:s"));
		$request->session()->forget('user');
		$request->session()->flush();
		return redirect('/');
	}

	public function registerStore(Request $request)
	{
		$request->validate([
			'korisnickoIme' => 'min:3|max:255|required|unique:korisnik,korisnicko_ime',
			'email' => 'required|email',
			'lozinka' => 'required|min:8|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/'
			]);

			$korisnicko_ime=$request->get('korisnickoIme');
			$lozinka = $request->get('lozinka');
			$email = $request->get('email');
			/*
			$slika = $request->file('slika');
			$tmp_putanja = $slika->getPathName(); 
			$ekstenzija = $slika->getClientOriginalExtension();
			$ime_fajla = time().'.'.$ekstenzija;
			$putanja = 'images/'.$ime_fajla;
		
			$putanja_server = public_path($putanja);*/

			try {
			/*File::move($tmp_putanja, $putanja_server);*/

			// unos u bazu

			$korisnik = new Korisnik();
			$korisnik->korisnicko_ime = $korisnicko_ime;
			$korisnik->email = $email;
			$korisnik->lozinka = $lozinka;

			$rez = $korisnik->save();

			if($rez == 1)
			{
			return redirect('/register')->with('message','Uspesna registracija!');
			}
			else
			{
				return redirect('/register')->with('message','Greska pri registraciji!');
			}
			}
			catch (\Exception $ex){
			\Log::error('MOJA GRESKA: '.$ex->getMessage());
		}

	}
}