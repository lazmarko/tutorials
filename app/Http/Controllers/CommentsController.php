<?php

namespace App\Http\Controllers;

use App\Models\CommentsModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function postComment(Request $request, $postId)
    {
        if ($request->get("content")) {
            $commentsModel = new CommentsModel();
            $commentsModel->content = $request->get("content");
            $commentsModel->korisnik_id=session()->get('user')[0]->id;
            $commentsModel->post_id = $postId;

            try {
                $commentsModel->save();
                \Log::info('Korisnik je dodao nov komentar: '.$request->session()->get('user')[0]->korisnicko_ime ." ".date("Y-m-d H:i:s"));
                return redirect()->back()->with('success', "Komentar uspesno dodat.");
            } catch (QueryException $e) {
                \Log::error("Greska pri dodavanju komentara " . $e->getMessage());
                return redirect()->back()->with('warning', "Doslo je do greske na serveru.");
            }

        }
        return redirect()->back()->with('warning', "Poruka ne sme biti prazna.");
    }
    public function showEditForm(Request $request, $commentId){

        $promenljiva=[];
        $commentModel=new CommentsModel();
        $promenljiva['comments']=$commentModel->getSingleComment($commentId);
        $request->session()->put('commentId',$commentId);
        return redirect()->back()->with('singlecomment',$promenljiva['comments']->tekst);
    }
    public function update(Request $request, $commentId){
        $commentsModel= new CommentsModel();
        $commentsModel->content=$request->get('content');
        $commentsModel->update($commentId);
        return redirect()->back()->with('success','Komentar editovan!');
    }
    public function delete($commentId)
    {
        $commentModel=new CommentsModel();
        $commentModel->delete($commentId);
        return redirect()->back()->with('success','Komentar obrisan!');

    }

}
