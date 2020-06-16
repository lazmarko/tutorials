<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use App\Models\Slika;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class GalleryController extends BackendController
{
    public function __construct()
    {
        parent::construct('admin.pages.gallery',"Gallery management", "Manage your webiste's gallery pictures", "gallery.create", "gallery.index");
        $this->model = new Gallery();
    }
     public function index()
    {
        $this->data['galleries'] = $this->model->all();
        return view($this->getView(), $this->data);
    }
    public function create()
    {
        $this->data['form'] = 'insert';
        return view('admin.pages.gallery', $this->data);
    }       
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|alpha_num|min:3|max:100|unique:galerija',
            'description' => 'required',
            'picture' => 'required|image|mimes:jpeg,png,jpg|max:2000'
        ];
        $validator = \Validator::make($request->all(), $rules);
        $validator->validate();

        try {



            $file = $request->file('picture');
            $directory = public_path("images/");
            $fileName = time() . "_" . $file->getClientOriginalName();
            $file->move($directory, $fileName);

            $slika = new slika();
            $slika->putanja = "images/" . $fileName;
            $slika->alt = "tutorijal gallery";

            $this->model->picture_id = $slika->save2();
            $this->model->title = $request->get('title');
            $this->model->description = $request->get('description');
            $this->model->save();
            
            return redirect(route('gallery.index'))->with("success", "Slika je uspesno dodata u galeriju!");
        } catch (FileException $e) {
            \Log::error("An error occured while uploading gallery picture " . $e->getMessage());
        } catch (QueryException $e) {
            \Log::error("An error occured while inserting gallery picture into database " . $e->getMessage());
        }
        return redirect()->back()->with("error", "An error occured, please try again later");
    }
    public function destroy($id)
    {
        try {
            $pictureId = $this->model->find($id)->slika_id;
            $this->model->delete($id);
            try {
                $pictureModel = new Slika();
                $picture = $pictureModel->find($pictureId);
                unlink(public_path($picture->putanja));
                $pictureModel->delete($pictureId);
            } catch(\Exception $e) {
                \Log::error("Greska pri brisanju slike galerije " . $e->getMessage());
            }
            return redirect()->back()->with("success", "Picture successfully deleted!");
        } catch (QueryException $e) {
            return redirect()->back()->with("error", "An error occured, please try again later");
        }
    }
        public function show($id)
    {
        $this->data['gallery'] = $this->model->find($id);
        $this->data['form'] = 'edit';
        return view($this->getView(), $this->data);
    }  
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required|alpha_num|min:3|max:100',
            'description' => 'required',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2000'
        ];
        $validator = \Validator::make($request->all(), $rules);
        $validator->validate();
        $oldPictureId = null;
        try {

            if ($request->hasFile("picture")) {
                $oldPictureId = $this->model->find($id)->slika_id;

                $file = $request->file('picture');
                $directory = public_path("images/");
                $fileName = time() . "_" . $file->getClientOriginalName();
                $file->move($directory, $fileName);

                $pictureModel = new Slika();
                $pictureModel->putanja = "images/" . $fileName;
                $pictureModel->alt = "blog gallery";

                $this->model->picture_id = $pictureModel->save();
            }

            $this->model->title = $request->get('title');
            $this->model->description = $request->get('description');
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

            return redirect()->back()->with("success", "Picture successfully updated!");
        } catch (FileException $e) {
            \Log::error("An error occured while uploading gallery picture " . $e->getMessage());
        } catch (QueryException $e) {
            \Log::error("An error occured while inserting gallery picture into database " . $e->getMessage());
        }
        return redirect()->back()->with("error", "An error occured, please try again later");
    }      
}


