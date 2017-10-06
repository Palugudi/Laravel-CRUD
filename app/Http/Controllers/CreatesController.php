<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\article;

class CreatesController extends Controller
{
    public function home1(){
    	$articles= article::all();
 
        return view('home1', ['articles' => $articles]);        
    }

    public function add(Request $request){
        $this->validate($request, [
        	'title' => 'required',
        	'description' => 'required'

        	]);
        $articles = new article;
        $articles->title = $request->input('title');
        $articles->description = $request->input('description');
        $articles->save();
        return redirect('/')->with('info','Article saved successfully!');
    }

    public function update($id){
         $articles= article::find($id);
         return view('update', ['articles' => $articles]);
         
         }

    public function edit(Request $request, $id){
    	$this->validate($request, [
        	'title' => 'required',
        	'description' => 'required'

        	]);
    	$data = array(
             'title'=> $request->input('title'),
             'description'=> $request->input('description')

    		);
    	article::where('id', $id)
    	->update($data);
    	return redirect('/')->with('info','Article Updated successfully!');
       
        

    }

    public function read($id){
    	$articles= article::find($id);
    	return view('read', ['articles' => $articles]);
        
        }

    public function delete($id){
    	article::where('id', $id)
    	->delete();
    	return redirect('/')->with('info','Article Deleted successfully!');
    }
}
