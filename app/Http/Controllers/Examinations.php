<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\MedicalExamination;
use Illuminate\Validation\Rule;

class Examinations extends Controller
{
    public function index() {
        $data = MedicalExamination::orderBy('id', 'DESC')->get();
        return view("examinations.index")->with(["data" => $data]);
    }

    public function create() {
        $categories=Category::all();
        return view("examinations.create")->with(["categories"=>$categories]);
    }

    public function store(Request $request) {
        $data = $request->all();
        MedicalExamination::create($data);
        return redirect("/examinations");
    }

    public function edit($id) {
        $item = MedicalExamination::find($id);
        return view("examinations.edit")->with(["item" => $item]);
    }

    public function update(Request $request) {
        $item = MedicalExamination::find($request->id);

        $data = $request->all();

        $item->fill($data)->save();

        return redirect()->back()->withSuccess(__('lang.changes_saved'));
    }

    public function destroy($id) {
        MedicalExamination::find($id)->delete();
        return redirect()->back();
    }
    public function getexamination() {
        $data = MedicalExamination::get();
        return response()->json($data);
    }

    public function categoryCreate(){
        return view('examinations.categorycreate');
    }

    public function categoryStore(Request $request){
        $rules=$this->rules();
        $request->validate($rules);
        $data = $request->all();
        Category::create($data);
        return redirect("/medicines/category/create");
    }

    public function rules($id=0){

        return  [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($id, 'id'),
            ],
        ];

    }

    public function categoryIndex(){
        $categories=Category::all();
        return view('examinations.categoryindex')->with(['categories'=>$categories]);
    }

    public function categoryEdit($id){
        $category=Category::findOrFail($id);
        return view('examinations.categoryedit')->with(["category"=>$category]);
    }

    public function categoryUpdate(Request $request,$id){

        $category=Category::findOrFail($id);
        $data = $request->all();
        $category->fill($data)->save();
        return redirect()->back()->withSuccess(__('lang.changes_saved'));

    }


}
