<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GrahamCampbell\GitHub\Facades\GitHub;

class Bug extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reporter',
        'category',
        'intended',
        'actual',
        'other',
        'page',
        'resolved',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function push(){
        GitHub::issues()->create('JacobKnox', 'FSC-File-Share', array('title' => $this->category . ': ' . substr($this->actual, 0, 60 - strlen($this->category)), 'body' => implode(PHP_EOL, $this->getInfo())));
    }

    public function getInfo(){
        return [$this->category, $this->intended, $this->actual, $this->other, $this->page];
    }
}
