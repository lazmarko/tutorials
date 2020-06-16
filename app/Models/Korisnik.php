<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Korisnik
{
	public $id;
	public $korisnicko_ime;
	public $lozinka;
	public $email;		
	public $uloga_id=2;
	private $table = 'korisnik';

	public function getAll(){
		$rezultat = DB::table('korisnik')
					->select('*', 'korisnik.id AS korisnikId')
					->join('uloga','uloga.id','=','korisnik.uloga_id')
					->get();
		return $rezultat;
	}

	public function get() {
		$rezultat = DB::table('korisnik')
					->select('*')
					->where('id',$this->id)
					->first();
		return $rezultat;
	}

	public function selectOne($id)
    {
        return DB::table($this->table)
            ->where("id", $id)->first();
    }

	public function getByUsernameAndPassword(){
		$rezultat = DB::table('korisnik')
					->select('korisnik.*','uloga.naziv')
					->join('uloga','korisnik.uloga_id', '=', 'uloga.id')
					->where([
						'korisnicko_ime' => $this->korisnicko_ime,
						'lozinka' => md5($this->lozinka)
					])
					->first();
		return $rezultat;
	}

	public function save() {
		$rez = DB::table('korisnik')->insert([
			'korisnicko_ime' => $this->korisnicko_ime,
			'lozinka' => md5($this->lozinka),
			'email' => $this->email,
			'uloga_id' => $this->uloga_id
		]);
		return $rez;
	}

    public function update($id)
    {
        return \DB::table($this->table)
            ->where("id", $id)
            ->update([
                'korisnicko_ime' => $this->korisnicko_ime,
                'lozinka' => md5($this->lozinka),
                'email' => $this->email,
                'uloga_id' => $this->uloga_id
            ]);
    }

    public function delete($id)
    {
        return \DB::table($this->table)
            ->delete($id);
    }
}
