<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Creation;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function create()
    {
        return view('/article/create'); 
    }

    public function store(Request $request)
    {
        $validate= Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'titre' => ['required', 'string','max:255'],
            'description' => ['required', 'string',],

            
        ]);
        if ($validate) {
            $imageName = time().'.'.$request->image->extension();  
   
            $request->image->move(public_path('images'), $imageName);
            $article=Article::create([
                'image' =>$imageName,
                'titre' => $request["titre"],
                'description' =>$request["description"],
                'user_id' =>Auth::user()->id,
            ]);
            return view('/article/show',compact('article'));
        }
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('/article/edit',compact('article'));
    }

    public function update(Request $request, $id)
{
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'titre' => ['required', 'string','max:255'],
            'description' => ['required', 'string',],

        ]);
        Article::whereId($id)->update($validatedData);

        return redirect('/article/show')->with('success', 'Article Data is successfully updated');
}


}
