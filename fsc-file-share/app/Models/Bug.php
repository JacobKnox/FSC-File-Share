<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Facades\Gate;

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

    public function pushToGH(): bool
    {
        $response = Gate::inspect('push-bug');
        if($response->allowed()){
            $this->pushGH();
            return true;
        }
        return false;
    }

    protected function pushGH(): void
    {
        // Need to add error handling here. Return true if successful, false if unsuccessful.
        GitHub::issues()->create('JacobKnox', 'FSC-File-Share', array('title' => $this->category . ': ' . substr($this->actual, 0, 60 - strlen($this->category)), 'body' => implode(PHP_EOL, $this->getInfo())));
    }

    public function info(): array | null
    {
        $response = Gate::inspect('view-bug', $this);
        if($response->allowed())
        {
            return $this->getInfo();
        }
        return null;
    }

    protected function getInfo(): array
    {
        return [$this->category, $this->intended, $this->actual, $this->other, $this->page];
    }
}
