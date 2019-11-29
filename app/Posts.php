<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    //some helper methods

    public function getRouteKeyName(){
        return 'slug';
    }

    public function path(){
        return "/dev/" . $this->featured == 1 ? "must-read/" : "" . $this->slug;
    }

    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getall(){
        return $this::where('status', 'published')->paginate(20);
    }

    public function featured(){
        return $this::where(['status' => 'published', 'featured' => '1'])->with('category')->latest()->limit(2)->get();
    }

    /**
     * This method calls posts that have a wordpress `gallery` post-type
     */

    public function gallery($limit = 3){
        return $this::where(['status' => 'published'])->with('category')->latest()->limit($limit)->get();
    }

    /**
     * This method calls posts that have a wordpress `quotes` post-type
     */
    public function quotes(){
        return $this::where(['status' => 'published', 'type' => 'quote'])->with('category')->latest()->limit(2)->get();
    }

    /**
     * This method calls posts that have a wordpress `aside` post-type
     */
    public function notables(){
        return $this::where(['status' => 'published', 'type' => 'aside'])->with('category')->latest()->limit(6)->get();
    }

    public function searchPost($slug){
        return $this::where(['slug' => $slug, 'status' => 'published'])->with('category')->get();
    }

    public function readTime(){
        //we need to exclude any tag(s) + images found
        $post = strip_tags($this->content);
        $words = str_word_count($post);
        $avgTime = 250;
        $time = ceil($words / $avgTime);

        return $time; //in minutes
    }

    public function postYears(){
        return $this::limit(3)->groupBy('year')->latest()->get('year');
    }

    public function postsByYear($year){
        return $this::where(['status' => 'published', 'year' => $year])->with('category')->get();
    }
}
