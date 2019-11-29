<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wordpress;
use App\Posts;

class PostsController extends Controller
{
    private $postModel;

    public function __construct()
    {
        $this->postModel = new Posts();        
    }

    //remove later
    public function fetchPosts(){
        $fetch = new Wordpress();
        $fetch->importPosts();
    }

    public function index(){
        return Posts::where('status', 'published')->with('category')->latest()->paginate(10);
    }

    public function featured(){
        return $this->postModel->featured();
    }

    public function gallery(){
        return $this->postModel->gallery();
    }

    public function quotes(){
        return $this->postModel->quotes();
    }

    public function notables(){
        return $this->postModel->notables();
    }

    public function view(){
        return view('single');
    }

    public function find(Request $slug){
        return $this->postModel->searchPost(request('slug'));
    }

    public function years(){
        return $this->postModel->postYears();
    }

    public function postsByYear(Request $year){
        return $this->postModel->postsByYear(request('year'));
    }
}
