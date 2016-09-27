<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * Get the user that owns the post.
     */
    
    public function user()
    {
        return $this->belongsTo('App\User', 'foreign_key');
    }
}
