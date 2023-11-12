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
    protected $casts = [];

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

    public function addLike(string $user_id)
    {
        if ($this->likes) {
            Like::create(['file_id' => $this->id, 'user_id' => $user_id]);
            $this->count_likes += 1;
            $this->save();
        }
    }

    public function removeLike(string $user_id)
    {
        Like::where(['file_id' => $this->id, 'user_id' => $user_id])->delete();
        $this->count_likes -= 1;
        $this->save();
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
        return File::create([
            'user_id' => $request->user()->id,
            'title' => $input['title'],
            'description' => $input['description'],
            'path' => $request->file('file')->storeAs('public\uploads', $request->file('file')->getClientOriginalName()),
            'comments' => isset($input['comments']) ? 1 : 0,
            'likes' => isset($input['likes']) ? 1 : 0,
            'downloads' => isset($input['downloads']) ? 1 : 0,
            'tags' => isset($input['tags']) ? json_encode($input['tags']) : null,
        ]);
    }

    public function updateFromInput($input)
    {
        $this->update([
            'title' => $input['title'],
            'description' => $input['description'],
            'comments' => isset($input['comments']) ? 1 : 0,
            'likes' => isset($input['likes']) ? 1 : 0,
            'downloads' => isset($input['downloads']) ? 1 : 0,
            'tags' => json_encode($input['tags']),
        ]);
        $this->save();
        return $this;
    }
}
