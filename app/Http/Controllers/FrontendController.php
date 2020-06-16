<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;
use App\Models\Meni;
use App\Models\Post;
use App\Models\Slika;
use App\Models\Gallery;
use App\Models\CommentsModel;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
/**
 * Description of FrontendController
 *
 * @author korisnik
 */
class FrontendController extends Controller {
    //put your code here
    private $data = [];

    public function __construct(){
    	$meni = new Meni();
    	$this->data['menus'] = $meni->getAll();
    }
    public function index(){
    	$post = new Post();
        $this->data['posts'] = $post->getAll();
        return view('pages.home', $this->data);
    }
    public function showRegistrationForm()
    {
        return view('pages.register', $this->data);
    }
    public function single($id)
    {
        $post = new Post();
        $post->id = $id;
        $this->data['post']=$post->get();

        $commentsModel = new CommentsModel();
        $commentsModel->post_id=$id;
        $this->data['comments'] = $commentsModel->getPostComments($id);
//        $this->data['post'] = $post;
        return view('pages.single',$this->data);
    }

    public function gallery()
    {
        $gallery = new Gallery();
        $this->data['galleries'] = $gallery->all();
        return view("pages.gallery", $this->data);
    }
    public function contact(){
        return view('pages.contact',$this->data);
    }
    public function kontaktPosalji(Request $request){
        $request->validate(
            [
                'name' => 'required|min:3',
                'email' => 'required|email',
                'headline' => 'required|min:3',
                'message' => 'required|min:3'
            ]
        );
//        $moj_email;
////        $moje
////        $data = array('name'=>$request->input('name'),
////                      "email" => $request->input('email'),
////                      "message" =>$request->input('message')
////            );
////        $email=$request->input('email');
////
////        mail::send($email,$data,function ($message) use )
///
    }
    public function autor()
    {
        return view("pages.autor",$this->data);
    }    

    public function createPost()
    {
        return view('pages.createPost',$this->data);   
    }
    public function storePost(Request $request)
    {
        $rules = [
            'title' => 'required',
            'body' => 'required',
            'embedLink' => 'required',
            'photo' => 'required|mimes:jpg,jpeg,png,gif|max:3000',
            'alt' => 'required'
        ];
        $custom_messages = [
            'required' => 'Polje :attribute je obavezno!',
            'title.regex' => 'Polje title nije u ispravnom formatu!',
            'max' => 'Fajl ne sme biti veci od :max KB.',
            'mimes' => 'Dozvoljeni formati su: :values.'
        ];
        $request->validate($rules, $custom_messages);   

        $photo = $request->file('photo');
        $extension = $photo->getClientOriginalExtension();
        $tmp_path = $photo->getPathName();
        
        $folder = 'images/';
        $file_name = time().".".$extension;
        $new_path = public_path($folder).$file_name;

        try {
            // 4 - Upload slike na server

            File::move($tmp_path, $new_path);

            // 5 - Unos slike u bazu

            $slika = new Slika();
            $slika->alt = trim($request->get('alt'));
            $slika->putanja = 'images/'.$file_name;
            $slika_id = $slika->save();

            // 6 - Unos posta u bazu
            $post = new Post();
            $post->naslov = $request->get('title');
            $post->sadrzaj = $request->get('body');
            $post->video = $request->get('embedLink');
            $post->korisnik_id = $request->session()->get('user')[0]->id;
            $post->slika_id = $slika_id;
            $post->save();

            // Ako se ne desi nijedan Exception - otici ce na pocetnu stranu!
            \Log::info('Korisnik je dodao nov tutorijal: '.$request->session()->get('user')[0]->korisnicko_ime ." ".date("Y-m-d H:i:s"));
            return redirect('/')->with('success','Uspesno ste dodali post i sliku!');
        }
        catch(\Illuminate\Database\QueryException $ex){ // greske u upitu
            \Log::error($ex->getMessage());
            return redirect()->back()->with('error','Greska pri dodavanju posta u bazu!');
        }
        catch(\Symfony\Component\HttpFoundation\File\Exception\FileException $ex) { // greske sa fajlom
            \Log::error('Problem sa fajlom!! '.$ex->getMessage());
            return redirect()->back()->with('error','Greska pri dodavanju slike!');
        }
        catch(\ErrorException $ex) { 
            \Log::error('Problem sa fajlom!! '.$ex->getMessage());
            return redirect()->back()->with('error','Desila se greska..');
        }             
    }
}
