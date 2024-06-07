<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'group_id',
        'title',
        'preview_img',
        'main_img',
        'deleted_at'
    ];
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tag_task');
    }

}
