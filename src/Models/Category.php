<?php

namespace DevDojo\Chatter\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'chatter_categories';
    public $timestamps = true;
    public $with = 'parents';

    public function discussions()
    {
        return $this->hasMany(Models::className(Discussion::class));
    }

    public function parents()
    {
        return $this->hasMany(Models::classname(self::class), 'parent_id')->orderBy('order', 'asc');
    }

    /*
     * Accessed with $category->url
     */
    public function getUrlAttribute() 
    {
        return config('chatter.routes.home') .'/'. config('chatter.routes.category') .'/'. $this->slug;
    }
}
