<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'relations';

    /**
     * Get the user that owns the relation.
     */
    
    public function user()
    {
        return $this->belongsTo('App\User', 'foreign_key');
    }

    

}
