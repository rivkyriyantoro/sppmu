

<?php $__env->startSection('site-name', 'Sistem Informasi SPP'); ?>
<?php $__env->startSection('page-name', 'Data Kelas'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h3 class="page-title">
            <?php echo $__env->yieldContent('page-name'); ?>
        </h3>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="d-flex justify-content-between p-2">
                    <h5 class="card-title"><?php echo $__env->yieldContent('page-name'); ?></h5>
                    <a href="<?php echo e(route('kelas.create')); ?>" class="btn btn-outline-primary btn-sm ml-5">Tambah Kelas</a>
                </div>
                <?php if(session()->has('msg')): ?>
                <div class="card-alert alert alert-<?php echo e(session()->get('type')); ?>" id="message" style="border-radius: 0px !important">
                    <?php if(session()->get('type') == 'success'): ?>
                        <i class="fe fe-check mr-2" aria-hidden="true"></i>
                    <?php else: ?>
                        <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> 
                    <?php endif; ?>
                        <?php echo e(session()->get('msg')); ?>

                </div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead class="table-light">
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Periode</th>
                            <th>Nama</th>
                            <th>Action</th> 
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><span class="text-muted"><?php echo e((($index+1) + ($kelas->currentPage() * $kelas->perPage()) - $kelas->perPage())); ?></span></td>
                                <td><?php echo e((isset($item->periode) ? $item->periode->nama : '-')); ?></td>
                                <td>
                                    <?php echo e($item->nama); ?>

                                </td>
                                <td class="text-center d-flex align-items-center">
                                    <a class="icon" href="<?php echo e(route('kelas.edit', $item->id)); ?>" title="kelas item">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a class="icon btn-delete" href="#!" data-id="<?php echo e($item->id); ?>" title="delete item">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                    <form action="<?php echo e(route('kelas.destroy', $item->id)); ?>" method="POST" id="form-<?php echo e($item->id); ?>">
                                        <?php echo method_field('DELETE'); ?>
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <div class="ml-auto mb-0">
                            <?php echo e($kelas->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function () {

        $(document).on('click','.btn-delete', function(){
            formid = $(this).attr('data-id');
            swal({
                title: 'Anda yakin ingin menghapus?',
                text: 'periode yang dihapus tidak dapat dikembalikan',
                dangerMode: true,
                buttons: {
                    cancel: true,
                    confirm: true,
                },
            }).then((result) => {
                if (result) {
                    $('#form-' + formid).submit();
                }
            })
        })

    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Aplikasi-Manajemen-SPP-Sekolah\resources\views/admin/kelas/index.blade.php ENDPATH**/ ?>