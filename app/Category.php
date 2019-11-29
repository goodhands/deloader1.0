<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

    protected $table = 'category';

    public function post(){
        return $this->hasMany(Posts::class);
    }
}
