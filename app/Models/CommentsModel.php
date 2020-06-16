<?php


namespace App\Models;


class CommentsModel
{
    public $content;
    public $post_id;
    public $korisnik_id;
    private $table = 'komentari';

    public function save()
    {
        return \DB::table($this->table)
            ->insert([
                'korisnik_id' => $this->korisnik_id,
                'post_id' => $this->post_id,
                'tekst' => $this->content,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
    }
    public function getSingleComment($commentId){
        return \DB::table($this->table)
            ->where('id',$commentId)
            ->first();
    }

    public function update($id)
    {
        return \DB::table($this->table)
            ->where('id', $id)
            ->update([
                'tekst' => $this->content,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
    }

    public function getPostComments($postId)
    {
        return \DB::table($this->table)
            ->join("korisnik", "komentari.korisnik_id", "=", "korisnik.id")
            ->where('post_id', $postId)
            ->select('komentari.*', 'korisnik.korisnicko_ime')
            ->get();
    }


    public function delete($id)
    {
        return \DB::table($this->table)
            ->delete($id);
    }



    public function find($id)
    {
        return \DB::table($this->table)
            ->where('id', $id)->get()->first();
    }

}