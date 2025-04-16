<?php $__env->startSection('content'); ?>
    <h4 class="text-center mb-4">Informasi Karyawan</h4>
    
    <div class="row">
        <div class="col-md-3">
            <div class="card text-center mb-3">
                <div class="card-body">
                    <?php if($karyawan->foto_profil): ?>
                        <img src="<?php echo e(asset('storage/' . $karyawan->foto_profil)); ?>"
                             alt="Foto Profil"
                             class="img-fluid rounded-circle mb-3"
                             style="max-width: 200px; height: auto;">
                    <?php else: ?>
                        <div class="text-muted">Belum ada foto profil</div>
                    <?php endif; ?>
                    <h5 class="mt-2"><?php echo e($karyawan->user->name); ?></h5>
                    <p class="mb-0"><?php echo e($karyawan->jabatan); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card mb-3">
                <div class="card-header fw-bold">Informasi Umum</div>
                <div class="card-body">
                    <table class="table mb-0">
                        <tr>
                            <th>Nama Lengkap</th>
                            <td><?php echo e($karyawan->user->name); ?></td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td><?php echo e($karyawan->jabatan); ?></td>
                        </tr>
                        <tr>
                            <th>Nama Panggilan</th>
                            <td><?php echo e($karyawan->nama_panggilan ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <th>Tempat, Tanggal Lahir</th>
                            <td>
                                <?php echo e($karyawan->tempat_lahir ?? '-'); ?>,
                                <?php echo e(optional($karyawan->tanggal_lahir)->format('d M Y') ?? '-'); ?>

                            </td>
                        </tr>
                        <tr>
                            <th>Golongan Darah</th>
                            <td><?php echo e($karyawan->golongan_darah ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td><?php echo e($karyawan->agama ?? '-'); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header fw-bold">Identitas</div>
                <div class="card-body">
                    <table class="table mb-0">
                        <tr>
                            <th>No KTP</th>
                            <td><?php echo e($karyawan->no_ktp ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <th>KTP Berlaku Sampai</th>
                            <td><?php echo e(optional($karyawan->ktp_berlaku_sampai)->format('d M Y') ?? '-'); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header fw-bold">Fisik</div>
                <div class="card-body">
                    <table class="table mb-0">
                        <tr>
                            <th>Tinggi Badan</th>
                            <td><?php echo e($karyawan->tinggi_badan ? $karyawan->tinggi_badan . ' cm' : '-'); ?></td>
                        </tr>
                        <tr>
                            <th>Berat Badan</th>
                            <td><?php echo e($karyawan->berat_badan ? $karyawan->berat_badan . ' kg' : '-'); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header fw-bold">Keluarga</div>
                <div class="card-body">
                    <table class="table mb-0">
                        <tr>
                            <th>Status</th>
                            <td><?php echo e($karyawan->status ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah Anak</th>
                            <td><?php echo e($karyawan->jumlah_anak ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <th>Anak Ke</th>
                            <td><?php echo e($karyawan->anak_ke ?? '-'); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header fw-bold">Kontak & Alamat</div>
                <div class="card-body">
                    <table class="table mb-0">
                        <tr>
                            <th>Alamat</th>
                            <td><?php echo e($karyawan->alamat ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <td><?php echo e($karyawan->no_hp ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <th>Tinggal dengan Keluarga</th>
                            <td><?php echo e($karyawan->tinggal_dengan_keluarga ? 'Ya' : 'Tidak'); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header fw-bold">Kontak Darurat</div>
                <div class="card-body">
                    <table class="table mb-0">
                        <tr>
                            <th>Nama</th>
                            <td><?php echo e($karyawan->darurat_nama ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <th>Hubungan</th>
                            <td><?php echo e($karyawan->darurat_hubungan ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td><?php echo e($karyawan->darurat_telepon ?? '-'); ?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td><?php echo e($karyawan->darurat_alamat ?? '-'); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <div class="card-header fw-bold">Keluarga</div>
                <div class="card-body">
                    <?php if($karyawan->keluargaLingkungan->isNotEmpty()): ?>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th style="min-width: 7.5rem">Hubungan</th>
                                        <th style="min-width: 10rem">Nama</th>
                                        <th>Gender</th>
                                        <th>Umur</th>
                                        <th>Pendidikan</th>
                                        <th style="min-width: 15rem">Alamat</th>
                                        <th>Profesi</th>
                                        <th>Telepon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $karyawan->keluargaLingkungan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keluarga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($keluarga->hubungan); ?></td>
                                            <td><?php echo e($keluarga->nama); ?></td>
                                            <td><?php echo e($keluarga->jenis_kelamin ?? '-'); ?></td>
                                            <td><?php echo e($keluarga->umur ?? '-'); ?></td>
                                            <td><?php echo e($keluarga->pendidikan ?? '-'); ?></td>
                                            <td><?php echo e($keluarga->alamat ?? '-'); ?></td>
                                            <td><?php echo e($keluarga->profesi ?? '-'); ?></td>
                                            <td><?php echo e($keluarga->telepon ?? '-'); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-muted">Belum ada data keluarga</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header fw-bold">Pengalaman Kerja</div>
                <div class="card-body">
                    <?php if($karyawan->pengalamanKerja->isNotEmpty()): ?>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th style="min-width: 10rem">Nama Perusahaan</th>
                                        <th style="min-width: 7.5rem">Jabatan</th>
                                        <th style="min-width: 10rem">Periode</th>
                                        <th>Gaji</th>
                                        <th style="min-width: 15rem">Alasan Keluar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $karyawan->pengalamanKerja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pengalaman): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($pengalaman->nama_perusahaan); ?></td>
                                            <td><?php echo e($pengalaman->jabatan); ?></td>
                                            <td><?php echo e($pengalaman->mulai_bulan); ?> <?php echo e($pengalaman->mulai_tahun); ?> - <?php echo e($pengalaman->sampai_bulan); ?> <?php echo e($pengalaman->sampai_tahun); ?></td>
                                            <td><?php echo e($pengalaman->gaji ?? '-'); ?></td>
                                            <td><?php echo e($pengalaman->alasan_keluar ?? '-'); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-muted">Belum ada data pengalaman kerja</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header fw-bold">Referensi</div>
                <div class="card-body">
                    <?php if($karyawan->referensi->isNotEmpty()): ?>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th style="min-width: 10rem">Nama</th>
                                        <th style="min-width: 7.5rem">Hubungan</th>
                                        <th style="min-width: 7.5rem">Jabatan</th>
                                        <th style="min-width: 15rem">Alamat</th>
                                        <th style="min-width: 7.5rem">Telepon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $karyawan->referensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referensi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($referensi->nama); ?></td>
                                            <td><?php echo e($referensi->hubungan); ?></td>
                                            <td><?php echo e($referensi->jabatan ?? '-'); ?></td>
                                            <td><?php echo e($referensi->alamat ?? '-'); ?></td>
                                            <td><?php echo e($referensi->telepon ?? '-'); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-muted">Belum ada data referensi</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header fw-bold">Dokumen Pendukung</div>
                <div class="card-body">
                    <?php if($karyawan->dokumenPendukung->isNotEmpty()): ?>
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Nama Dokumen</th>
                                    <th>Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $karyawan->dokumenPendukung; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dokumen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($dokumen->nama_dokumen); ?></td>
                                        <td><a href="<?php echo e(asset('storage/' . $dokumen->file_path)); ?>" target="_blank">Lihat Dokumen</a></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="text-muted">Belum ada dokumen pendukung</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <a href="<?php echo e(route('admin.karyawan.view')); ?>" class="btn btn-secondary mt-3">Kembali</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('_layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\worksync\resources\views/admin/karyawan/detail.blade.php ENDPATH**/ ?>