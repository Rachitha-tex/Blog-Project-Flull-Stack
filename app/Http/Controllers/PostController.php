<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'title'=>['required'],
            'file'=>['required','image'],
            'body'=>['required'],
            'category_id'=>['required']
        ]);

        $title=$request->title;
        $category_id=$request->category_id;

        if(!Post::count()){
            $postId=1;
        }else{
            $postId=Post::latest()->first()->id +1;
        }

        $slug=Str::slug($title,'-').'-'.$postId;
        $user_id=auth()->user()->id;
        $body=$request->input('body');
        $imagePath='storage/'. $request->file('file')->store('postImages','public');

        //create and save
        $post=new Post();
        $post->title=$title;
        $post->slug=$slug;
        $post->category_id=$category_id;
        $post->body=$body;
        $post->user_id=$user_id;
        $post->imagePath=$imagePath;

        $post->save();
    }

    public function show(Post $post){
        if(auth()->user()->id !== $post->user->id){
            return abort(403);
        }
        return new PostResource($post);
    }

    public function index(Request $request){
        if($request->category){
            return PostResource::collection(Category::where('name',$request->category)->firstOrFail()->posts()->latest()->paginate(1)->withQueryString());
        }else if($request->search){
            return PostResource::collection(Post::where('title','like','%'.$request->search.'%')
            ->orWhere('body','like','%'.$request->search.'%')->latest()->paginate(1)->withQueryString()
        );
        }
        return PostResource::collection(Post::latest()->paginate(1));
    }

    public function update(Request $request,Post $post){

        if(auth()->user()->id !== $post->user->id){
            return abort(403);
        }
        $request->validate([
            'title'=>['required'],
            'file'=>['nullable','image'],
            'body'=>['required'],
            'category_id'=>['required']
        ]);

        $title=$request->title;
        $category_id=$request->category_id;

        $slug=Str::slug($title,'-').'-'.$post->id;
        $body=$request->input('body');

        
        if($request->file('file')){
            File::delete($post->imagePath);
            $imagePath='storage/'. $request->file('file')->store('postImages','public');
            $post->imagePath=$imagePath;
        }
  
       

        //create and save
        $post->title=$title;
        $post->slug=$slug;
        $post->category_id=$category_id;
        $post->body=$body;
        $post->save();
    }

    public function destroy(Post $post){
        if(auth()->user()->id !== $post->user->id){
            return abort(403);
        }
        return $post->delete();
    }

}
