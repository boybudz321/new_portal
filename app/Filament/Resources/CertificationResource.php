<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CertificationResource\Pages;
use App\Models\Certification;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CertificationResource extends Resource
{
    protected static ?string $model = Certification::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    protected static ?string $navigationGroup = 'Seafarer Management';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('seaman_id')
                    ->label('Seaman ID')
                    ->numeric()
                    ->placeholder('Enter seaman ID'),

                Forms\Components\TextInput::make('cert_id')
                    ->label('Certificate ID')
                    ->required()
                    ->placeholder('Enter certificate ID'),

                Forms\Components\TextInput::make('expire_days')
                    ->label('Expire Days')
                    ->numeric()
                    ->placeholder('Enter expire days'),

                Forms\Components\TextInput::make('expire_months')
                    ->label('Expire Months')
                    ->numeric()
                    ->placeholder('Enter expire months'),

                Forms\Components\TextInput::make('expiry_status')
                    ->label('Expiry Status')
                    ->placeholder('Enter expiry status'),

                Forms\Components\DatePicker::make('to_date')
                    ->label('To Date')
                    ->placeholder('Select to date'),

                Forms\Components\DatePicker::make('from_date')
                    ->label('From Date')
                    ->placeholder('Select from date'),

                Forms\Components\Toggle::make('is_valid')
                    ->label('Is Valid'),

                Forms\Components\Toggle::make('is_flag')
                    ->label('Is Flag'),

                Forms\Components\Toggle::make('is_unlimited')
                    ->label('Is Unlimited'),

                Forms\Components\TextInput::make('licence_number')
                    ->label('License Number')
                    ->required()
                    ->placeholder('Enter license number'),

                Forms\Components\TextInput::make('issuer')
                    ->label('Issuer')
                    ->placeholder('Enter issuer'),

                Forms\Components\TextInput::make('issuer_country')
                    ->label('Issuer Country')
                    ->placeholder('Enter issuer country'),

                Forms\Components\Toggle::make('is_archive')
                    ->label('Is Archive'),

                Forms\Components\Toggle::make('is_required')
                    ->label('Is Required'),

                Forms\Components\Toggle::make('is_verified')
                    ->label('Is Verified'),

                Forms\Components\Textarea::make('notes')
                    ->label('Notes')
                    ->placeholder('Enter notes'),

                Forms\Components\TextInput::make('_check_sum')
                    ->label('Check Sum')
                    ->placeholder('Enter check sum'),

                Forms\Components\TextInput::make('group_id')
                    ->label('Group ID')
                    ->placeholder('Enter group ID'),

                Forms\Components\TextInput::make('group_name')
                    ->label('Group Name')
                    ->placeholder('Enter group name'),

                Forms\Components\Toggle::make('is_confidential')
                    ->label('Is Confidential'),

                Forms\Components\TextInput::make('issuer_country_name')
                    ->label('Issuer Country Name')
                    ->placeholder('Enter issuer country name'),

                Forms\Components\TextInput::make('cert_stcw_code')
                    ->label('STCW Code')
                    ->placeholder('Enter STCW code'),

                Forms\Components\TextInput::make('cert_export_id')
                    ->label('Export ID')
                    ->placeholder('Enter export ID'),

                Forms\Components\TextInput::make('cert_name')
                    ->label('Certificate Name')
                    ->placeholder('Enter certificate name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cert_name')
                    ->label('Certificate Name')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('licence_number')
                    ->label('License Number')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('seaman_id')
                    ->label('Seaman ID')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\IconColumn::make('is_valid')
                    ->label('Valid')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_verified')
                    ->label('Verified')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('from_date')
                    ->label('From Date')
                    ->date()
                    ->sortable()
                    ->placeholder('N/A')
                    ->formatStateUsing(fn(?Carbon $state): string => $state == "-0001-11-30 00:00:00" ? "N/A" : $state),

                Tables\Columns\TextColumn::make('to_date')
                    ->label('To Date')
                    ->sortable()
                    ->placeholder('N/A')
                    ->formatStateUsing(fn(?Carbon $state): string => $state == "-0001-11-30 00:00:00" ? "N/A" : $state),

                Tables\Columns\IconColumn::make('is_unlimited')
                    ->label('Unlimited')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('expiry_status')
                    ->label('Expiry Status')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('expire_days')
                    ->label('Days to Expire')
                    ->numeric()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('expire_months')
                    ->label('Months to Expire')
                    ->numeric()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('issuer')
                    ->label('Issuer')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('issuer_country_name')
                    ->label('Issuer Country')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('cert_stcw_code')
                    ->label('STCW Code')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\IconColumn::make('is_flag')
                    ->label('Flag')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_required')
                    ->label('Required')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_confidential')
                    ->label('Confidential')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_archive')
                    ->label('Archived')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('group_name')
                    ->label('Group Name')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('notes')
                    ->label('Notes')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A')
                    ->limit(50),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created Date')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('N/A'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListCertifications::route('/'),
            'create' => Pages\CreateCertification::route('/create'),
            'edit' => Pages\EditCertification::route('/{record}/edit'),
        ];
    }
}
