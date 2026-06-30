<?php

namespace App\Services;

use App\Models\ProdukStok;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StokService
{
    public function tambah(int $produk_id, int $jumlah, string $kode, ?string $keterangan = null, $detail_id = null, array $extra = []): ProdukStok
    {
        $this->pastikanJumlahPositif($produk_id, $jumlah);

        return ProdukStok::create(array_merge([
            'produk_id' => $produk_id,
            'tambah' => $jumlah,
            'kurang' => 0,
            'kode' => $kode,
            'keterangan' => $keterangan,
            'detail_id' => $detail_id,
        ], $extra));
    }

    public function kurang(int $produk_id, int $jumlah, string $kode, ?string $keterangan = null, $detail_id = null, array $extra = [], bool $validasiStok = true): ProdukStok
    {
        $this->pastikanJumlahPositif($produk_id, $jumlah);

        if ($validasiStok) {
            $this->pastikanStokCukup($produk_id, $jumlah);
        }

        return ProdukStok::create(array_merge([
            'produk_id' => $produk_id,
            'tambah' => 0,
            'kurang' => $jumlah,
            'kode' => $kode,
            'keterangan' => $keterangan,
            'detail_id' => $detail_id,
        ], $extra));
    }

    public function saldoTersedia($produk_id): int
    {
        return (int) DB::table('produk_stoks')
            ->where('produk_id', $produk_id)
            ->whereNull('deleted_at')
            ->orderBy('id', 'desc')
            ->value('saldo') ?? 0;
    }

    public function updateLastStok($produk_id): void
    {
        if (!DB::table('produks')->where('id', $produk_id)->exists()) {
            return;
        }

        $saldo = $this->saldoTersedia($produk_id);

        DB::table('produk_last_stoks')->updateOrInsert(
            ['produk_id' => $produk_id],
            ['saldo' => $saldo, 'updated_at' => now()]
        );
    }

    private function pastikanJumlahPositif(int $produk_id, int $jumlah): void
    {
        if ($jumlah <= 0) {
            throw ValidationException::withMessages([
                'jumlah' => 'Jumlah untuk ' . $this->labelProduk($produk_id)
                    . ' harus lebih dari 0 (diisi ' . $jumlah . ').',
            ]);
        }
    }

    private function pastikanStokCukup(int $produk_id, int $jumlah): void
    {
        if ($jumlah <= 0) {
            return;
        }

        $tersedia = $this->saldoTersedia($produk_id);

        if ($jumlah > $tersedia) {
            throw ValidationException::withMessages([
                'jumlah' => 'Stok tidak cukup untuk ' . $this->labelProduk($produk_id)
                    . '. Tersedia ' . $tersedia . ', diminta ' . $jumlah . '.',
            ]);
        }
    }

    private function labelProduk(int $produk_id): string
    {
        try {
            $nama = trim((string) DB::table('produks')
                ->leftJoin('produk_models', 'produk_models.id', '=', 'produks.produk_model_id')
                ->where('produks.id', $produk_id)
                ->selectRaw("CONCAT(COALESCE(produk_models.nama, ''), ' ', COALESCE(produks.nama, '')) as label")
                ->value('label'));

            if ($nama !== '') {
                return $nama;
            }
        } catch (\Throwable $e) {
            // abaikan — pakai fallback id
        }

        return 'produk #' . $produk_id;
    }
}
