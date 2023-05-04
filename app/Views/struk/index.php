<body>
    <div class="text-center">
        <p class="judul">Zhot Petshop</p>
        <p class="judul">Karawang Timur</p>
        <p class="nohp">08xxxxxxxxxx (Telp / WA)</p>
        <hr class="border-2" style="display: hidden;">


        <table class="strukTabel mx-auto table table-bordered">
            <tr>
                <td width="40%" class="strukIsi">Tanggal</td>
                <td width="5%" class="strukIsi">:</td>
                <td width="55%" class="strukIsi"><?= date("d-F-Y"); ?></td>
            </tr>
            <tr>
                <td class="strukIsi">id</td>
                <td class="strukIsi">:</td>
                <td class="strukIsi"><?= $id_transaksi; ?></td>
            </tr>
            <tr>
                <td class="strukIsi">Kasir</td>
                <td class="strukIsi">:</td>
                <td class="strukIsi"><?= $username; ?></td>
            </tr>
        </table>
        <hr class="border-2" style="display: hidden;">

        <table class="strukTabel mx-auto table  table-bordered">
            <?php foreach ($penjualan as $j) : ?>
                <tr>
                    <td colspan="3" class="strukIsi"><?= $j['nama_barang']; ?></td>
                </tr>
                <tr>
                    <td class="strukIsi"><?= number_format($j['harga_ecer'], 0, '', ','); ?></td>
                    <td class="strukIsi">x<?= $j['qty']; ?></td>
                    <td class="right strukIsi"><?= number_format((int)$j['harga_ecer'] * (int)$j['qty'], 0, '', ','); ?></td>
                </tr>
            <?php endforeach; ?>
        </table class="strukTabel">
        <hr class="border-2" style="display: hidden;">
        <table class="strukTabel mx-auto table table-bordered">
            <tr>
                <td class="strukIsi">SUBTOTAL</td>
                <td class="strukIsi">:</td>
                <td class="right strukIsi"><?= number_format($subtotal, 0, '', ','); ?></td>
            </tr>
            <tr>
                <td class="strukIsi">DISKON</td>
                <td class="strukIsi">:</td>
                <td class="right strukIsi"><?= number_format($diskon, 0, '', ','); ?></td>
            </tr>
            <tr>
                <td class="strukIsi">TOTAL</td>
                <td class="strukIsi">:</td>
                <td class="right strukIsi"><?= number_format($total, 0, '', ','); ?></td>
            </tr>
            <tr>
                <td class="strukIsi">CASH</td>
                <td class="strukIsi">:</td>
                <td class="right strukIsi"><?= number_format($bayar, 0, '', ','); ?></td>
            </tr>
            <tr>
                <td class="strukIsi">KEMBALI</td>
                <td class="strukIsi">:</td>
                <td class="right strukIsi"><?= number_format($kembalian, 0, '', ','); ?></td>
            </tr>
        </table>
        <hr class="border-2" style="display: hidden;">
        <p class="judul">Terima Kasih</p>
    </div>
</body>