Schema::create('barang', function (Blueprint $table) {
    $table->id();
    $table->string('kode_barang')->unique();
    $table->string('nama');
    $table->string('kategori');
    $table->integer('stok');
    $table->decimal('harga', 10, 2);
    $table->timestamps();
});
