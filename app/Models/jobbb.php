<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Job extends Model

{
    use HasFactory;

    public function tag(string $name){

        $tag = Tag::firstOrCreate(['name' => $name]);

        $this->tags()->attach($tag);

    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function employer(){
        return $this->belongsTo(Employer::class);
    }

    protected static function boot()
{
    parent::boot();

    static::saving(function ($job) {
        if (empty($job->slug)) {
            $job->slug = Str::slug($job->title) . '-' . Str::random(6);
        }
    });
}
}






    
