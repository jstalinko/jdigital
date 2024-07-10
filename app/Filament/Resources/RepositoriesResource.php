<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Repositories;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RepositoriesResource\Pages;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Filament\Resources\RepositoriesResource\RelationManagers;

class RepositoriesResource extends Resource
{
   // protected static ?string $model = Repositories::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('filenames')
                ->label('Upload Files')
                ->required()
                ->disk('local')
                ->directory('repositories')
                ->visibility('private')
                ->downloadable()
                ->acceptedFileTypes(['application/zip', 'application/x-rar-compressed', 'application/x-tar', 'application/x-7z-compressed'])
                ->multiple()
                ->columnSpanFull()
                ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                    return '[JavaraDigital]_' . $file->getClientOriginalName();
                }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('filename')
                ->label('Filename')
                ->sortable()
                ->searchable(),
            TextColumn::make('size')
                ->label('Size')
                ->sortable(),
            TextColumn::make('last_modified')
                ->label('Last Modified')
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageRepositories::route('/'),
        ];
    }
}



/**
 <?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Tables;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class Repositories extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.repositories';
    protected function getHeaderActions(): array
    {
        return [
            Action::make('Upload File')
                ->form([
                    FileUpload::make('filenames')
                        ->label('Upload Files')
                        ->required()
                        ->disk('local')
                        ->directory('repositories')
                        ->visibility('private')
                        ->downloadable()
                        ->acceptedFileTypes(['application/zip', 'application/x-rar-compressed', 'application/x-tar', 'application/x-7z-compressed'])
                        ->multiple()
                        ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                            return '[JavaraDigital]_' . $file->getClientOriginalName();
                        }),
                ])
                ->action(function (array $data) {
                    $this->uploadFiles($data);
                })
        ];
    }

    public function uploadFiles(array $data)
    {
        $files = $data['filenames'] ?? [];

        foreach ($files as $file) {
            Notification::make('success')
                ->title('File Uploaded')
                ->body("File " . basename($file) . " has been uploaded successfully.")->success()->send();
        }
        // Refresh the table after upload
      //  $this->emit('refreshTable');
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('filename')
                    ->label('Filename')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('size')
                    ->label('Size')
                    ->sortable(),
                TextColumn::make('last_modified')
                    ->label('Last Modified')
                    ->sortable(),
            ])
            ->query(function(\App\Models\Repositories $repo){
                return $repo->getRows();
            })
            ->filters([])
            ->actions([])
            ->bulkActions([]);
    }

    
}
*/