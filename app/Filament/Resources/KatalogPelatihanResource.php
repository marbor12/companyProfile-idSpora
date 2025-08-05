<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KatalogPelatihanResource\Pages;
use App\Filament\Resources\KatalogPelatihanResource\RelationManagers;
use App\Models\KatalogPelatihan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KatalogPelatihanResource extends Resource
{
    protected static ?string $model = KatalogPelatihan::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    
    protected static ?string $navigationLabel = 'Katalog Pelatihan';
    
    protected static ?string $modelLabel = 'Katalog Pelatihan';
    
    protected static ?string $pluralModelLabel = 'Katalog Pelatihan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pelatihan')
                    ->schema([
                        Forms\Components\TextInput::make('nama_pelatihan')
                            ->label('Nama Pelatihan')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->columnSpanFull(),
                        
                        Forms\Components\Select::make('tipe_pelatihan')
                            ->label('Tipe Pelatihan')
                            ->options([
                                'berbayar' => 'Pelatihan Berbayar',
                                'free' => 'Pelatihan Free',
                                'khusus' => 'Pelatihan Khusus (Request Client)',
                            ])
                            ->required()
                            ->reactive(),
                        
                        Forms\Components\Select::make('kategori')
                            ->label('Kategori')
                            ->options([
                                'IT & Programming' => 'IT & Programming',
                                'Digital Marketing' => 'Digital Marketing',
                                'Bisnis & Manajemen' => 'Bisnis & Manajemen',
                                'Desain Grafis' => 'Desain Grafis',
                                'Fotografi' => 'Fotografi',
                                'Video Editing' => 'Video Editing',
                                'Lainnya' => 'Lainnya',
                            ]),
                        
                        Forms\Components\Select::make('level')
                            ->label('Level')
                            ->options([
                                'Beginner' => 'Beginner',
                                'Intermediate' => 'Intermediate',
                                'Advanced' => 'Advanced',
                            ]),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Detail Pelatihan')
                    ->schema([
                        Forms\Components\DatePicker::make('tanggal_pelatihan')
                            ->label('Tanggal Pelatihan')
                            ->required(),
                        
                        Forms\Components\TextInput::make('harga')
                            ->label('Harga')
                            ->numeric()
                            ->prefix('Rp')
                            ->step(0.01)
                            ->hidden(fn (callable $get) => $get('tipe_pelatihan') === 'free'),
                        
                        Forms\Components\TextInput::make('instructor')
                            ->label('Instruktur')
                            ->maxLength(255),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Materi & Info Tambahan')
                    ->schema([
                        Forms\Components\Textarea::make('materi')
                            ->label('Materi Pembelajaran')
                            ->rows(4)
                            ->columnSpanFull(),
                        
                        Forms\Components\Textarea::make('client_info')
                            ->label('Informasi Client')
                            ->rows(3)
                            ->columnSpanFull()
                            ->visible(fn (callable $get) => $get('tipe_pelatihan') === 'khusus')
                            ->helperText('Informasi khusus dari client untuk pelatihan custom'),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_pelatihan')
                    ->label('Nama Pelatihan')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('tipe_pelatihan')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'berbayar' => 'success',
                        'free' => 'info',
                        'khusus' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'berbayar' => 'Berbayar',
                        'free' => 'Free',
                        'khusus' => 'Khusus',
                        default => $state,
                    }),
                
                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('level')
                    ->label('Level')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Beginner' => 'success',
                        'Intermediate' => 'warning',
                        'Advanced' => 'danger',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('tanggal_pelatihan')
                    ->label('Tanggal Pelatihan')
                    ->date()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable()
                    ->getStateUsing(fn ($record) => $record->tipe_pelatihan === 'free' ? 0 : $record->harga)
                    ->formatStateUsing(fn ($state, $record) => $record->tipe_pelatihan === 'free' ? 'GRATIS' : 'Rp ' . number_format($state, 0, ',', '.')),
                
                Tables\Columns\TextColumn::make('instructor')
                    ->label('Instruktur')
                    ->searchable(),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tipe_pelatihan')
                    ->label('Tipe Pelatihan')
                    ->options([
                        'berbayar' => 'Pelatihan Berbayar',
                        'free' => 'Pelatihan Free',
                        'khusus' => 'Pelatihan Khusus',
                    ]),
                
                Tables\Filters\SelectFilter::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'IT & Programming' => 'IT & Programming',
                        'Digital Marketing' => 'Digital Marketing',
                        'Bisnis & Manajemen' => 'Bisnis & Manajemen',
                        'Desain Grafis' => 'Desain Grafis',
                        'Fotografi' => 'Fotografi',
                        'Video Editing' => 'Video Editing',
                        'Lainnya' => 'Lainnya',
                    ]),
                
                Tables\Filters\SelectFilter::make('level')
                    ->label('Level')
                    ->options([
                        'Beginner' => 'Beginner',
                        'Intermediate' => 'Intermediate',
                        'Advanced' => 'Advanced',
                    ]),
                
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
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
            'index' => Pages\ListKatalogPelatihans::route('/'),
            'create' => Pages\CreateKatalogPelatihan::route('/create'),
            'edit' => Pages\EditKatalogPelatihan::route('/{record}/edit'),
        ];
    }
}
