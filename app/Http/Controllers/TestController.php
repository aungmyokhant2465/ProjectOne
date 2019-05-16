<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function getHome(){
        return view('home');
    }
    public function getWelcome(){
        $post=Post::OrderBy('id','desc')->paginate('2');
        return view('welcome')->with(['posts'=>$post]);
    }
    public function postNewPost(Request $request){
        $title=$request['title'];
        $content=$request['content'];
        $this->validate($request,[
            'title'=>'required|min:5|max:20',
            'content'=>'required'
        ]);
        $post=new Post();
        $post->title=$title;
        $post->content=$content;
        $post->save();
        return redirect()->route('welcome');
    }
    public function postRemove($id){
        $post=Post::whereId($id)->firstOrFail();
        $post->delete();
        return redirect()->back()->with('info',"The item have been deleted");
    }
    public function postEdit($id){
        $post=Post::where('id',$id)->firstOrFail();
        return view('edit')->with(['post'=>$post]);
    }
    public function postUpdate(Request $request){
        $id=$request['id'];
        $title=$request['title'];
        $content=$request['content'];
        $post=Post::whereId($id)->firstOrFail();
        $post->title=$title;
        $post->content=$content;
        $post->update();
        return redirect()->route('welcome')->with('info','The item have been updated');
    }
    public function postSearch(Request $request){
        $q=$request['q'];
        $post=Post::where("id", "LIKE","%$q%")->orWhere("title","LIKE","%$q%")->orWhere("content","LIKE","%$q%")->paginate();
        return view('welcome')->with(['posts'=>$post]);
    }
}
