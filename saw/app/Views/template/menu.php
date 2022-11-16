<?php $uri = service('uri'); ?>

<li <?php echo $uri->getSegment(1) == '' || $uri->getSegment(1) == 'home' ? 'class="active"' : ''; ?>><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> <span>Home</span></a></li>

<?php if (session('level') == 'Admin') : ?>
    <li <?php echo ($uri->getSegment(1) == 'kriteria' || $uri->getSegment(1) == 'subkriteria') ? 'class="active"' : ''; ?>><a href="<?php echo base_url('kriteria'); ?>"><i class="fa fa-tags"></i> <span>Kriteria</span></a></li>
    <li <?php echo $uri->getSegment(1) == 'alternatif' ? 'class="active"' : ''; ?>><a href="<?php echo base_url('alternatif'); ?>"><i class="fa fa-list"></i> <span>Alternatif</span></a></li>
    <li <?php echo $uri->getSegment(1) == 'penilaian' ? 'class="active"' : ''; ?>><a href="<?php echo base_url('penilaian'); ?>"><i class="fa fa-check"></i> <span>Penilaian</span></a></li>
    <li <?php echo $uri->getSegment(1) == 'laporan' ? 'class="active"' : ''; ?>><a href="<?php echo base_url('laporan'); ?>"><i class="fa fa-print"></i> <span>Laporan</span></a></li>
    <li <?php echo $uri->getSegment(1) == 'pengguna' ? 'class="active"' : ''; ?>><a href="<?php echo base_url('pengguna'); ?>"><i class="fa fa-user"></i> <span>Pengguna</span></a></li>

<?php elseif (session('level') == 'User') : ?>
    <li <?php echo $uri->getSegment(1) == 'penilaian' ? 'class="active"' : ''; ?>><a href="<?php echo base_url('penilaian'); ?>"><i class="fa fa-check"></i> <span>Penilaian</span></a></li>
    <li <?php echo $uri->getSegment(1) == 'laporan' ? 'class="active"' : ''; ?>><a href="<?php echo base_url('laporan'); ?>"><i class="fa fa-print"></i> <span>Laporan</span></a></li>
<?php endif; ?>

<li <?php echo $uri->getSegment(1) == 'password' ? 'class="active"' : ''; ?>><a href="<?php echo base_url('password'); ?>"><i class="fa fa-unlock-alt"></i> <span>Ubah Password</span></a></li>
<li><a href="<?php echo base_url('logout'); ?>"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>