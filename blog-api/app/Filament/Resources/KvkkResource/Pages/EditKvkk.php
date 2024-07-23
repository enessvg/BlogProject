<?php

namespace App\Filament\Resources\KvkkResource\Pages;

use App\Filament\Resources\KvkkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKvkk extends EditRecord
{
    protected static string $resource = KvkkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
