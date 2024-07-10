<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sushi\Sushi;
class Repositories extends Model
{
    use Sushi;
    use HasFactory;
    protected $fillable = [
        'filenames',
        'filename'
    ];
    protected function scanDirectory()
    {
        $files = Storage::disk('local')->files('repositories');
        $fileDetails = [];

        foreach ($files as $file) {
            $fileDetails[] = [
                'filename' => basename($file),
                'size' => Storage::disk('local')->size($file),
                'last_modified' => date('Y-m-d H:i:s', Storage::disk('local')->lastModified($file)),
            ];
        }

        return $fileDetails;
    }

    public function getRows()
    {
        return $this->scanDirectory();
    }
}
