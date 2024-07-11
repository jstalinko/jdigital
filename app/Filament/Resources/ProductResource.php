<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\GithubController;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationGroup = 'Product Management';
    protected static ?int $navigationSort=1;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    public static $repoName = 'h';
    public static $assets = [];


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('General')->schema([
                    Forms\Components\Select::make('category_id')
                        ->required()
                        ->options(Category::where('active', true)->pluck('name', 'id'))
                        ->native(false),
                    Forms\Components\TextInput::make('name')
                        ->required()->reactive()->afterStateUpdated(function(Set $set,$state){
                            return $set('slug',$state);
                        }),
                    Forms\Components\TextInput::make('slug'),
                    Forms\Components\TagsInput::make('tags')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('price')
                        ->required()
                        ->numeric()
                        ->prefix('$'),
                    Forms\Components\TextInput::make('discount')
                        ->required()
                        ->numeric()
                        ->default(0),
                    Forms\Components\FileUpload::make('image')
                        ->image()
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\RichEditor::make('description')
                        ->required()
                        ->columnSpanFull()
                ]),
                Forms\Components\Section::make('Product Detail')->schema([
                    Forms\Components\Select::make('product_type')->options(['file' => 'File', 'github' => 'Github Repo'])->required()->native(false)->reactive()->afterStateUpdated(function (Set $set, $state) {
                        if ($state == 'file') {
                            $paths = glob(storage_path('app/repositories') . '/*.zip');
                            $asset = [];
                            foreach ($paths as $path) {
                                $asset[url('/download/{product_id}?file=' . basename($path))] = basename($path);
                            }
                            self::$assets = $asset;
                        }
                    }),
                    Forms\Components\Select::make('github_repo')->options(function () {
                        $response = (new \App\Http\Controllers\GithubController)->ghCollection('repo');
                        return collect($response)->pluck('name', 'name');
                    })->native(false)->reactive()->afterStateUpdated(function (Set $set, $state) {
                        self::$repoName = $state;
                        $response = (new \App\Http\Controllers\GithubController)->ghCollection('release', ['repoName' => $state]);
                        $release = (new \App\Http\Controllers\GithubController)->ghCollection('asset', ['repoName' => $state, 'releaseId' => $response['id']]);
                        $rele = collect($release)->pluck('name', 'url');
                        self::$assets = $rele;
                        return $set('release_id' , $response['id']);
                    })->hidden(fn (callable $get) => !$get('product_type') || $get('product_type') !== 'github'),
                    Forms\Components\Hidden::make('release_id'),
                    Forms\Components\Select::make('product_file')->options(fn () => self::$assets)->hidden(fn (callable $get) => !$get('product_type'))
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount')
                    ->sortable()
                    ->suffix('%'),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
