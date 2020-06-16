<?php

namespace App\Http\Controllers\Admin;

use App\Models\Korisnik;
use App\Models\Uloga;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends BackendController
{
	public function __construct()
	{
		 parent::construct('admin.pages.users',"Users management", "Manage your webiste's users", "users.create", "users.index");
		 $this->model = new Korisnik();
	}		 
    public function index()
    {
        $this->data['korisnici'] = $this->model->getAll();
        return view($this->getView(), $this->data);
    }
    public function create()
    {
        $this->data['form'] = 'insert';
        $uloga = new Uloga();
        $this->data['roles'] = $uloga->selectAll();
        return view($this->getView(), $this->data);
    }
    public function store(Request $request)
    {
        //Definisanje pravila za validaciju
        $rules = [
            'korisnickoIme' => 'required|alpha|min:4|max:20',
            'email' => 'required|email|unique:korisnik',
            'lozinka' => [
                'required',
                'min:6',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/'
            ],
            'role_id' => 'required'
        ];

        //Kastomizacija poruka
        $messages = [
            "password.regex" => 'Password must contain one uppercase letter and one number.',
            'role_id.required' => 'User role must be selected.'
        ];

        //Primena validacije, ukoliko je ima grešaka vrši se redirekcija requesta- na prethodnu stranu sa sve greškama
        $validator = \Validator::make($request->all(), $rules, $messages);
        $validator->validate();

        //Ukoliko je validacija uspesna, korisnik se upisuje u bazu

        $korisnik = new Korisnik();
        $korisnik->korisnicko_ime = $request->get('korisnickoIme');
        $korisnik->email = $request->get("email");
        $korisnik->lozinka = $request->get("lozinka");
        $korisnik->uloga_id = $request->get("role_id");
        try {
            $korisnik->save();
            return redirect(route("users.index"))->with("success", "Korisnik uspesno dodat!!");
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with("error", "Doslo je do greske, pokusajte kasnije!");
        }
    }
        public function show($id)
    {
        $this->data['korisnik'] = $this->model->selectOne($id);
        $this->data['form'] = 'edit';

        $uloga = new Uloga();
        $this->data['roles'] = $uloga->selectAll();
        return view($this->getView(), $this->data);
    }
    public function update(Request $request, $id)
    {
        //Definisanje pravila za validaciju
        $rules = [
            'korisnickoIme' => 'required|alpha|min:4|max:20',
            'email' => 'required|email|unique:korisnik',
            'lozinka' => [
                'required',
                'min:6',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/'
            ],
            'role_id' => 'required'
        ];

        //Kastomizacija poruka
        $messages = [
            "password.regex" => 'Password must contain one uppercase letter and one number.',
            'role_id.required' => 'User role must be selected.'
        ];

        //Primena validacije, ukoliko je ima grešaka vrši se redirekcija requesta- na prethodnu stranu sa sve greškama
        $validator = \Validator::make($request->all(), $rules, $messages);
        $validator->validate();

        //Ukoliko je validacija uspesna, korisnik se upisuje u bazu

        $korisnik = new Korisnik();
        $korisnik->korisnicko_ime = $request->get('korisnickoIme');
        $korisnik->email = $request->get("email");
        $korisnik->lozinka = $request->get("lozinka");
        $korisnik->uloga_id = $request->get("role_id");

        try {
            $korisnik->update($id);
            return redirect(route("users.index"))->with("success", "Korisnik uspesno izmenjen!");
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with("error", "Doslo je do greske, pokusajte kasnije!");
        }
    }
        public function destroy($id)
    {
        try {
            $this->model->delete($id);
            return redirect(route("users.index"))->with("success", "Korisnik uspesno obrisan");
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect(route("users.index"))->with("error", "Doslo je do greske, pokusajte kasnije!");
        }
    }            		 
	
}
