<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Meni {
    public $route;
    public $name;
    private $table = 'meni';
    
    public function getAll(){
        $rezultat = DB::table('meni')->get();
        return $rezultat;
    }
    public function save()
    {
        return \DB::table($this->table)
                ->insertGetId([
                    'link' => $this->route,
                    'naziv' => $this->name
                ]);
    }
    public function delete($id)
    {
        return \DB::table($this->table)
            ->delete($id);
    }
        public function find($id)
    {
        return \DB::table($this->table)->where('id', $id)->get()->first();
    }
    public function update($id)
    {
        return \DB::table($this->table)
            ->where('id', $id)
            ->update([
                'link' => $this->route,
                'naziv' => $this->name
            ]);
    }            
}
