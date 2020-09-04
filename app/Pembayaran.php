<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = "pembayaran";

    protected $fillable = ["tanggal_pembayaran", "transaksi_id", "pembayaran_ke", "nominal", "keterangan", "user_id"];
}
