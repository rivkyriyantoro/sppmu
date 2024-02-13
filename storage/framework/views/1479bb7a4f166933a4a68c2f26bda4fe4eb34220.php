<table>
    <thead>
    <tr>
        <th><b>Tanggal</b></th>
        <th><b>Siswa</b></th>
        <th><b>Tagihan</b></th>
        <th><b>Diskon</b></th>
        <th><b>Dibayarkan</b></th>
        <th><b>Keterangan</b></th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($item->created_at->format('d-m-Y')); ?></td>
            <td><?php echo e($item->siswa->nama.'('.$item->siswa->kelas->nama.')'); ?></td>
            <td><?php echo e($item->tagihan->nama); ?></td>
            <td>IDR. <?php echo e(format_idr($item->diskon)); ?></td>
            <td>IDR. <?php echo e(format_idr($item->keuangan->jumlah)); ?></td>
            <td style="max-width:150px;"><?php echo e($item->keterangan); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table><?php /**PATH D:\xampp\htdocs\Aplikasi-Manajemen-SPP-Sekolah\resources\views/admin/transaksi/transaksiexport.blade.php ENDPATH**/ ?>