<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Wordpress extends Model
{
    protected $url = 'http://localhost/business_eyes/wp-json/wp/v2/';
    protected $newPost;

    public function importPosts($page = 1){
        $posts = collect($this->getJson($this->url . 'posts/?_embed&filter[orderby]=modified&page=' . $page));
        foreach ($posts as $post) {
            $this->syncPost($post);
        }
    }

    protected function getJson($url){
        $response = file_get_contents($url, false);
        return json_decode( $response );
    }

    protected function syncPost($data){
        $found = Posts::where('wp_id', $data->id)->first();

        if (! $found) {
            return $this->createPost($data);
        }

        if ($found && $found->updated_at->format("Y-m-d H:i:s") < $this->carbonDate($data->modified)->format("Y-m-d H:i:s")) {
            return $this->updatePost($found, $data);
        }
    }

    protected function updatePost($found, $data){
        $the_post = Posts::find($found->id);
        //hope to refactor this when my brain is settled
        $the_post->id = $data->id;
        $the_post->wp_id = $data->id;
        $the_post->author_id = $data->author;
        $the_post->title = $data->title->rendered;
        $the_post->slug = $data->slug;
        $the_post->featured_image = $this->featuredImage($data->_embedded);
        $the_post->featured = ($data->sticky) ? 1 : null;
        $the_post->excerpt = ltrim( rtrim( strip_tags( str_limit($data->excerpt->rendered, 100) ), "," ), ",");
        $the_post->content = $data->content->rendered;
        $the_post->type = $data->format;
        $the_post->status = 'published';
        // $the_post->publishes_at = $this->carbonDate($data->date);
        $the_post->created_at = $this->carbonDate($data->date);
        $the_post->updated_at = $this->carbonDate($data->modified);
        $the_post->category_id = $this->getCategory($data->_embedded->{"wp:term"});
        $the_post->save();
        // $this->syncTags($post, $data->_embedded->{"wp:term"});
        return $the_post;
    }

    protected function carbonDate($date){
        // return "2018-10-30 00:07:44";
        return Carbon::parse($date);
    }
    // $post = new Posts();

    /**
     * This method may also be used to update already existing post
     */
    protected function createPost($data) {

        $the_post = new Posts();

        $the_post->id = $data->id;
        $the_post->wp_id = $data->id;
        $the_post->author_id = $data->author;
        $the_post->title = $data->title->rendered;
        $the_post->slug = $data->slug;
        $the_post->featured_image = $this->featuredImage($data->_embedded);
        $the_post->featured = ($data->sticky) ? 1 : null;
        $the_post->excerpt = ltrim( rtrim( strip_tags( str_limit($data->excerpt->rendered, 100) ), "," ), ",");
        $the_post->content = $data->content->rendered;
        $the_post->type = $data->format;
        $the_post->status = ($data->status == "publish" ? "published" : $data->status);
        // $the_post->publishes_at = $this->carbonDate($data->date);
        $the_post->created_at = $this->carbonDate($data->date);
        $the_post->updated_at = $this->carbonDate($data->modified);
        $the_post->category_id = $this->getCategory($data->_embedded->{"wp:term"});
        $the_post->year = date("Y", strtotime($data->date));
        $the_post->save();
        // $this->syncTags($post, $data->_embedded->{"wp:term"});
        return $the_post;
    }

    public function featuredImage($data) {
        if (property_exists($data, "wp:featuredmedia")) {
            $data = head($data->{"wp:featuredmedia"});
            if (isset($data->source_url)) {
                return $data->source_url;
            }
        }
        return null;
    }

    public function getCategory($data) {
        $category = collect($data)->collapse()->where('taxonomy', 'category')->first();
        $found = Category::where('wp_id', $category->id)->first();
        if ($found) {
            return $found->id;
        }
        $cat = new Category();
        $cat->id = $category->id;
        $cat->wp_id = $category->id;
        $cat->title = $category->name;
        $cat->slug = $category->slug;
        $cat->description = '';
        $cat->save();
        return $cat->id;
    }

}