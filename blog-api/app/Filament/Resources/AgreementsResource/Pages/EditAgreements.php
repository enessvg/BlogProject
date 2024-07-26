<?php

namespace App\Filament\Resources\AgreementsResource\Pages;

use App\Filament\Resources\AgreementsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAgreements extends EditRecord
{
    protected static string $resource = AgreementsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
