<?php

namespace App\Http\Controllers\Admin;

use App\Models\Meni;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NavigationController extends BackendController
{
    public function __construct()
    {
        parent::construct('admin.pages.navigation',"Navigation links management", "Manage your webiste's main navigation", "navigation.create", "navigation.index");
        $this->model = new Meni();
    }
    public function index()
    {
        $this->data['navigations'] = $this->model->getAll();
        return view($this->getView(), $this->data);
    }
    public function create()
    {
        $this->data['form'] = 'insert';
        return view($this->getView(), $this->data);
    }
    public function store(Request $request)
    {
        $rules = [
          'route' => 'required',
          'name' => 'required'
        ];
        $validator = \Validator::make($request->all(), $rules);
        $validator->validate();

        try {
            $this->model->route = $request->get('route');
            $this->model->name = $request->get("name");
            $this->model->save();
            return redirect(route('navigation.index'))->with("success", "Navigation link successfully added!");
        } catch(QueryException $e) {
            \Log::error("Greska pri unosu navigacionog linka " . $e->getMessage());
            return redirect()->back()->with("error", "An error occurred, please try again later");
        }
    }
    public function destroy($id)
    {
        try {
            $this->model->delete($id);
            return redirect(route('navigation.index'))->with("success", "Navigation link successfully deleted!");
        } catch (QueryException $e) {
            \Log::error("Greska pri brisanju navigacionog linka: " . $e->getMessage());
            return redirect()->back()->with("error", "An error occurred, please try again later");
        }
    }
        public function show($id)
    {
        $this->data['form'] = 'edit';
        $this->data['navigation'] = $this->model->find($id);
        return view($this->getView(), $this->data);
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'route' => 'required',
            'name' => 'required'
        ];
        $validator = \Validator::make($request->all(), $rules);
        $validator->validate();

        try {
            $this->model->route = $request->get('route');
            $this->model->name = $request->get("name");
            $this->model->update($id);
            return redirect(route('navigation.index'))->with("success", "Navigation link successfully updated!");
        } catch(QueryException $e) {
            \Log::error("Greska pri unosu izmeni linka " . $e->getMessage());
            return redirect()->back()->with("error", "An error occurred, please try again later");
        }
    }                    	
}