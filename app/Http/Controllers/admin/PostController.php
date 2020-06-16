<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slika;
use App\Models\Post;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Illuminate\Support\Facades\File;

class PostController extends BackendController
{
    public function __construct()
    {
        parent::construct('admin.pages.posts',"Blog posts management", "Manage your webiste's blog posts", "posts.create", "posts.index");
        $this->model = new Post();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['posts'] = $this->model->getAll2();
        return view($this->getView(), $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['form'] = "insert";
        return view($this->getView(), $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'video' => 'required',
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
            $post->sadrzaj = $request->get('description');
            $post->video = $request->get('video');
            $post->korisnik_id = $request->session()->get('user')[0]->id;
            $post->slika_id = $slika_id;
            $post->save();

            // Ako se ne desi nijedan Exception - otici ce na pocetnu stranu!
            \Log::info('Korisnik je dodao nov tutorijal: '.$request->session()->get('user')[0]->korisnicko_ime ." ".date("Y-m-d H:i:s"));
            return redirect(route('posts.index'))->with("success", "Post uspesno dodat!");
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['form'] = 'edit';
        $this->data['post'] = $this->model->get2($id);
        return view($this->getView(), $this->data);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'video' => 'required',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2000'
        ];
        $validator = \Validator::make($request->all(), $rules);
        $validator->validate();
        $oldPictureId = null;
        try {

            if ($request->hasFile("picture")) {
                $oldPictureId = $this->model->get2($id)->slika_id;

                $file = $request->file('picture');
                $directory = public_path("images/");
                $fileName = time() . "_" . $file->getClientOriginalName();
                $file->move($directory, $fileName);

                $pictureModel = new Slika();
                $pictureModel->putanja = "images/" . $fileName;
                $pictureModel->alt = "blog gallery";

                $this->model->slika_id = $pictureModel->save2();
            }

            $this->model->naslov = $request->get('title');
            $this->model->sadrzaj = $request->get('description');
            $this->model->video = $request->get('video');            
            $this->model->update($id);

            try {
                if($oldPictureId) {
                    $pictureModel = new Slika();
                    $picture = $pictureModel->find($oldPictureId);
                    unlink(public_path($picture->putanja));
                    $pictureModel->delete($oldPictureId);
                }
            } catch (\Exception $e) {
                \Log::error("Greska pri brisanju slike navigacije: " . $e->getMessage());
            }

            return redirect(route('posts.index'))->with("success", "Post je izmenjen!");
        } catch (FileException $e) {
            \Log::error("An error occured while uploading gallery picture " . $e->getMessage());
        } catch (QueryException $e) {
            \Log::error("An error occured while inserting gallery picture into database " . $e->getMessage());
        }
        return redirect()->back()->with("error", "An error occured, please try again later");
    } 


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->model->delete($id);
            return redirect()->back()->with("success", "Post successfully deleted!");
        } catch (\Exception $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with("error", "An error occurred, please try again later");
        }
    }
}
