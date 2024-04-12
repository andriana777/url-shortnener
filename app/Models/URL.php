<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class URL extends Model
{
    use HasFactory;

    protected $table = 'url';
    protected $fillable = [
        'long_url',
        'short_url',
        'times',
    ];

    public function save_short($long_url) : void
    {
        $this->long_url = $long_url;
        $hash = crc32($long_url);
        $this->short_url = substr(base_convert($hash, 10, 36), 0, 4);
        $this->save();
    }

    public function searchByHash($short_url) : string
    {
        $url =  $this->where('short_url', $short_url)->first();
        $url->update(['times' => $url->times + 1]);
        return $url->long_url;
    }
    public function url_exists($value, $field = 'long_url') : bool
    {
        $url_exists = self::where($field, $value)->exists();
        return $url_exists;
    }
}
