<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Post {
	public $id;
	public $naslov;
	public $video;
	public $sadrzaj;
	public $korisnik_id;
	public $slika_id;

	public function getAll(){
		$rezultat = DB::table('post')
					->select('*','post.id as postId')
					->join('slika as s','post.slika_id','=','s.id')
					->join('korisnik as k','post.korisnik_id','=','k.id')
					->orderBy('post.created_at','desc')
					->paginate(2);
		return $rezultat;

	}
	public function getAll2(){
		$rezultat = DB::table('post')
					->select('*','post.id as postId')
					->join('slika as s','post.slika_id','=','s.id')
					->join('korisnik as k','post.korisnik_id','=','k.id')
					->orderBy('post.created_at','desc')
					->get();
		return $rezultat;	
	}
	public function get(){
		return DB::table('post')
				->select('*','post.id as postId')
				->join('slika as s','post.slika_id','=','s.id')
				->join('korisnik as k','post.korisnik_id','=','k.id')
				->where('post.id', $this->id)
				->orderBy('post.created_at','desc')
				->first();
	}
	public function get2($id){
		return DB::table('post')
				->select('*','post.id as postId')
				->join('slika as s','post.slika_id','=','s.id')
				->join('korisnik as k','post.korisnik_id','=','k.id')
				->where('post.id', $id)				
				->first();
	}	
	
		public function save() {
		$rezultat = DB::table('post')->insert([
			'naslov' => $this->naslov,
			'sadrzaj' => $this->sadrzaj,
			'video' => $this->video,
			'korisnik_id' => $this->korisnik_id,
			'created_at' => time(),
			'slika_id' => $this->slika_id
		]);
		return $rezultat;
	}	
    public function delete($id)
    {
        return \DB::table('post')
            ->delete($id);
    }

    public function update($id)
    {
        $updateData = [
            'naslov' => $this->naslov,
            'sadrzaj' => $this->sadrzaj,
            'video' => $this->video
        ];
        if ($this->slika_id != null) {
          $updateData['slika_id'] = $this->slika_id;
        }
        return \DB::table('post')
            ->where('id', $id)
            ->update($updateData);
    }   
}