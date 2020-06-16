<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Slika {

	public $id;
	public $alt;
	public $putanja;

	public function save(){
		$id = DB::table('slika')
				->insertGetId([
					'alt' => $this->alt,
					'putanja' => $this->putanja
				]);
		return $id;
	}
    public function save2()
    {
        return \DB::table('slika')
            ->insertGetId([
                'putanja' => $this->putanja,
                'alt' => $this->alt
            ]);
    }	
    public function find($id)
    {
        return \DB::table('slika')
            ->where('id', $id)
            ->get()
            ->first();
    }
    public function delete($id)
    {
        return \DB::table('slika')
            ->delete($id);
    }        
}