<?php

namespace App\Http\Controllers;

use App\Models\ServiceClass;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceClassesController extends Controller {

     public function index() {
         $classes = ServiceClass::get();

         return view('service_classes.index', compact('classes'));
     }

     public function create() {
         return view('service_classes.create');
     }

     public function store(Request $request) {
         request()->validate([
             'name' => 'required'
         ]);

         $class = new ServiceClass();

         $class->name = $request->name;
         $class->created_by = Auth::id();
         $class->updated_by = Auth::id();

         try {
             $class->save();

             flash("Class has been created")->success();
             return redirect('/service_classes/index');
         }  catch (QueryException $e) {
             flash("An error occurred. Please try again!")->error();
             return back()->withInput();
         }
     }

     public function edit($id) {
         $class = ServiceClass::find($id);

         return view('service_classes.edit', compact('class'));
     }

    public function update(Request $request) {
        request()->validate([
            'name' => 'required'
        ]);

        $class = ServiceClass::find($request->id);

        $class->name = $request->name;
        $class->updated_by = Auth::id();

        try {
            $class->save();

            flash("Class has been updated")->success();
            return redirect('/service_classes/index');
        }  catch (QueryException $e) {
            flash("An error occurred. Please try again!")->error();
            return back()->withInput();
        }
    }

    public function delete($id) {
        $class = ServiceClass::find($id);

        try {
            $class->delete();

            flash("Class has been deleted")->success();
        }  catch (QueryException $e) {
            flash("An error occurred. Please try again!")->error();
        }

        return redirect('/service_classes/index');
    }
}
