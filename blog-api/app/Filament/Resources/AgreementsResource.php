<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgreementsResource\Pages;
use App\Filament\Resources\AgreementsResource\RelationManagers;
use App\Models\Agreements;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;


class AgreementsResource extends Resource
{
    protected static ?string $model = Agreements::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Admin';
    protected static ?string $navigationLabel = 'Agreements';
    protected static ?int $navigationSort = 53;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                ->schema([
                    Section::make('Detail')
                        ->schema([
                            TextInput::make('title')
                            ->required()
                            ->live(debounce:'1000')
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                            TextInput::make('slug')->required(),

                            // TextInput::make('title')
                            //     ->label('Title')
                            //     ->required()
                            //     ->live(onBlur: true)
                            //     ->unique(ignoreRecord: true)
                            //     ->afterStateUpdated(function(string $operation, $state, Forms\Set $set) {
                            //         if ($operation !== 'create') {
                            //             return;
                            //         }

                            //         $set('slug', Str::slug($state));
                            //     }),

                            // TextInput::make('slug')
                            //     ->disabled()
                            //     ->dehydrated()
                            //     ->required(),

                            MarkdownEditor::make('description')
                                ->label('Details')
                                ->columnSpan('full')
                                ->required(),
                        ])
                        ->columns(2),
                ])
                ->columnSpanFull(),//buraya kadar
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('description')->limit(100),
                TextColumn::make('updated_at')->label('Last Updated')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgreements::route('/'),
            'create' => Pages\CreateAgreements::route('/create'),
            'edit' => Pages\EditAgreements::route('/{record}/edit'),
        ];
    }
}
