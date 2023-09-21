<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

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

    public function access()
    {
        return response()->file($this->path);
    }

    public function download()
    {
        return $this->downloads ? response()->download($this->path) : back();
    }

    public function store(UploadedFile $file, string $path, string $disk)
    {
        $file->store($path, $disk);
    }
}
