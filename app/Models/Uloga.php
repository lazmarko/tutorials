<?php

namespace App\Models;

class Uloga
    {
        public $name;

        public function selectAll()
        {
            return \DB::table("uloga")->get();
        }

        public function insert()
        {
        return \DB::table('uloga')
                ->insertGetId([
                'naziv' => $this->name
                ]);
        }

        public function delete($id)
        {
            return \DB::table("uloga")
                ->delete($id);
        }

        public function update($id)
        {
            return \DB::table('uloga')
                ->where('id', $id)
                ->update([
                'naziv' => $this->name
                ]);
        }

        public function selectOne($id)
        {
            return \DB::table('uloga')
                ->where('id', $id)
                ->get()
                ->first();
        }
    }