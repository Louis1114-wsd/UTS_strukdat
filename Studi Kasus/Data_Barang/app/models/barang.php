class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'nama',
        'kategori',
        'stok',
        'harga',
    ];
}
