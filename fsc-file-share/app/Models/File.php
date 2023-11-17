<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'path',
        'tags',
        'comments',
        'likes',
        'downloads',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getLikes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function getComments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function access()
    {
        return response()->file(Storage::path($this->path));
    }

    public function download()
    {
        return $this->downloads ? response()->download(Storage::path($this->path)) : back();
    }

    public function tags()
    {
        return json_decode($this->tags);
    }

    public static function createFromInput($request, $input)
    {
        $words = config('mod.inappropriate_words');
        $checks = ['title', 'description'];
        dd($words);

        $file = File::create([
            'user_id' => $request->user()->id,
            'title' => $input['title'],
            'description' => $input['description'],
            'path' => $request->file('file')->storeAs('public\uploads', $request->file('file')->getClientOriginalName()),
            'comments' => isset($input['comments']) ? 1 : 0,
            'likes' => isset($input['likes']) ? 1 : 0,
            'downloads' => isset($input['downloads']) ? 1 : 0,
            'tags' => isset($input['tags']) ? json_encode($input['tags']) : null,
        ]);

        $info = '';
        foreach($words as $word)
        {
            foreach($checks as $check)
            {
                if(str_contains($input[$check], $word))
                {
                    $info .= $check.' contains '.$word.',';
                }
            }
        }
        if($info != '')
        {
            Report::create([
                'reporter' => 0,
                'type' => 1,
                'reported' => $file->id,
                'category' => 'Inappropriate Words',
                'info' => $info,
            ]);
            $file->visible = 0;
            $file->save();
        }

        return $file;
    }

    public function updateFromInput($input)
    {
        $this->update([
            'title' => $input['title'],
            'description' => $input['description'],
            'comments' => isset($input['comments']) ? 1 : 0,
            'likes' => isset($input['likes']) ? 1 : 0,
            'downloads' => isset($input['downloads']) ? 1 : 0,
            'tags' => isset($input['tags']) ? json_encode($input['tags']) : $this->tags,
        ]);
        $this->save();
        return $this;
    }
}
