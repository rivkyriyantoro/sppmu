

<?php $__env->startSection('site-name','Sistem Informasi SPP'); ?>
<?php $__env->startSection('page-name','Menu'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1 class="page-title">
        <?php echo $__env->yieldContent('page-name'); ?>
    </h1>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title"><?php echo $__env->yieldContent('page-name'); ?></h5>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-default">
                    <i class="fas fa-plus"></i> Tambah Data
                </button>
            </div>
            <?php if(session()->has('msg')): ?>
            <div class="card-alert alert alert-<?php echo e(session()->get('type')); ?>" id="message"
                style="border-radius: 0px !important">
                <?php if(session()->get('type') == 'success'): ?>
                <i class="fe fe-check mr-2" aria-hidden="true"></i>
                <?php else: ?>
                <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i>
                <?php endif; ?>
                <?php echo e(session()->get('msg')); ?>

            </div>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table card-table table-hover table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Menu</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><span class="text-muted"><?php echo e($loop->iteration); ?></span></td>
                            <td><?php echo e($item->menu_nama); ?></td>
                            <td>
                                <?php $__currentLoopData = $item->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge badge-success"> <?php echo e($p->name); ?> </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td><?php echo e($item->description); ?></td>
                            <td class="text-center d-flex align-items-center">
                                <a class="icon" href="" title="edit item">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a class="icon btn-delete" href="#!" data-id="<?php echo e($item->id); ?>" title="delete item">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <form action="" method="POST" id="form-<?php echo e($item->id); ?>">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </td>
                        </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title">Tambah Menu</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-bs-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('menu.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="menu">Nama Menu</label><?php $__errorArgs = ['menu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <input type="text" required name="menu" class="form-control <?php $__errorArgs = ['menu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            id="menu" placeholder="Masukan Nama Menu">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
                    text: 'user yang dihapus tidak dapat dikembalikan',
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Aplikasi-Manajemen-SPP-Sekolah\resources\views/admin/menu/index.blade.php ENDPATH**/ ?>