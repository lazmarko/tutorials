<?php


namespace App\Models;
use Illuminate\Support\Facades\DB;



class Gallery
{
    public $title;
    public $description;
    public $picture_id;
    private $table = 'galerija';

    public function all()
    {
        return DB::table('galerija')
            ->join('slika', 'galerija.slika_id', '=', 'slika.id')
            ->select("galerija.*", "slika.putanja AS putanja", "slika.alt AS alt")
            ->get();
    }
    public function save()
    {
        return \DB::table($this->table)
            ->insertGetId([
               'title' => $this->title,
               'description' => $this->description,
               'slika_id' => $this->picture_id
            ]);
    }
    public function find($id)
    {
        return \DB::table($this->table)
            ->join('slika', 'galerija.slika_id', '=', 'slika.id')
            ->where('galerija.id', $id)
            ->select("galerija.*", "slika.putanja", "slika.alt")
            ->get()->first();
    }        
    public function delete($id)
    {
        return \DB::table($this->table)
            ->delete($id);
    }
    public function update($id)
    {
        if($this->picture_id) {
            $updateData = [
                'title' => $this->title,
                'description' => $this->description,
                'slika_id' => $this->picture_id
            ];
        } else {
            $updateData = [
                'title' => $this->title,
                'description' => $this->description
            ];
        }
        return \DB::table($this->table)
            ->where('id', $id)
            ->update($updateData);
    }   
}
