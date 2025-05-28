use Filament\Forms;
use Filament\Tables;
use Filament\Resouces\Resource;
use App\Models\Barang;
use Filament\Resources\Form;
use Filament\Resources\Table;

class BarangResource extends Resource
{ 
    protected static ?string $model = Barang::class;
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationIcon = 'Data Barang';
    protected static ?string $navigationIcon = 'Manajemen Gudang';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('kode_barang')->required()->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('nama')->required(),
            Forms\Components\TextInput::make('kategori')->required(),
            Forms\Components\TextInput::make('stok')->numeric()->required(),
            Forms\Components\TextInput::make('harga')->numeric()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_barang')->searchable(),
                Tables\Columns\TextColumn::make('nama')->searchable(),
                Tables\Columns\TextColumn::make('kategori')->searchable(),
                Tables\Columns\TextColumn::make('stok')->sortable(),
                Tables\Columns\TextColumn::make('harga')->money('IDR'),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal Input')->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->options(fn () => Barang::query()->pluck('kategori', 'kategori')->unique()->toArray()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}