<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
<<<<<<< HEAD
=======
use Filament\Actions;
>>>>>>> temp
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;
<<<<<<< HEAD

    protected function getRedirectUrl(): string
    {
        return '/admin/posts';
    }
=======
>>>>>>> temp
}
