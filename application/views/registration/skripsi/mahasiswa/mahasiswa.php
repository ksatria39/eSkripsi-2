<?php
$showAddButton = true;
if (is_array($mySkripsi) && !empty($mySkripsi)) {
	$latestSkripsi = $mySkripsi[0];
	if ($latestSkripsi->skp_status == "Sedang diproses" || $latestSkripsi->skp_status == "Diterima") {
		$showAddButton = false;
	} elseif ($latestSkripsi->skp_status == "Ditolak") {
		$showAddButton = true;
	}
} else {
	$latestSkripsi = (object)[
		'status_ujian_skripsi' => 'Belum terdaftar',
	];
	$showAddButton = true;
}

if (!$hasApprovedTitle) {
	$showAddButton = false;
}

if ($latestSkripsi->status_ujian_skripsi == "Tidak lulus" || $latestSkripsi->status_ujian_skripsi == "Belum terdaftar") {
	$this->load->model('Skpregister_model');
	$progress_dospem_1 = $this->Skpregister_model->count_progress($myTitle->id, $myTitle->dospem_1_id);
	$progress_dospem_2 = $this->Skpregister_model->count_progress($myTitle->id, $myTitle->dospem_2_id);

	$progress_dospem_1 = 6;
	$progress_dospem_2 = 6;

	if ($progress_dospem_1 >= 6 && $progress_dospem_2 >= 6) {
		$showAddButton = true;
	} else {
		$showAddButton = false;
	}
} else {
	$showAddButton = false;
}
?>

<section class="section">
	<div class="card">
		<div class="card-body" style="padding-top: <?php if (!$showAddButton) {
														echo "1rem";
													} else {
														echo "4rem";
													} ?>;">


			<?php if ($this->session->flashdata('success')) : ?>
				<div class="alert alert-info alert-dismissible fade show" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php endif; ?>

			<?php if (empty($mySkripsi)) { ?>
				<p>Anda belum mendaftar untuk mengikuti ujian skripsi.</p>
			<?php } else { ?>

				<table class="table datatable">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Judul</th>
							<th scope="col">Tanggal Pendaftaran</th>
							<th scope="col">Naskah</th>
							<th scope="col">Lembar Persetujuan</th>
							<th scope="col">Transkrip Nilai</th>
							<th scope="col">Bukti Pembayaran</th>
							<th scope="col">Pembimbing 1</th>
							<th scope="col">Pembimbing 2</th>
							<th scope="col">Status</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($mySkripsi as $skripsi) { ?>
							<tr>
								<th scope="row"><?= $no++; ?></th>
								<td><?= $skripsi->judul; ?></td>
								<td><?= format_tgl($skripsi->tanggal_pendaftaran); ?></td>
								<td><a class="btn btn-primary" href="<?= base_url() ?>registration_skripsi/view_file/naskah/<?= $skripsi->file_naskah; ?>">Lihat</a></td>
								<td><a class="btn btn-primary" href="<?= base_url() ?>registration_skripsi/view_file/persetujuan/<?= $skripsi->file_persetujuan; ?>">Lihat</a></td>
								<td><a class="btn btn-primary" href="<?= base_url() ?>registration_skripsi/view_file/transkrip/<?= $skripsi->file_transkrip; ?>">Lihat</a></td>
								<td><a class="btn btn-primary" href="<?= base_url() ?>registration_skripsi/view_file/ukt/<?= $skripsi->file_ukt; ?>">Lihat</a></td>
								<td>
									<?php
									$dosen1 = $this->db->where('id', $skripsi->dospem_1_id)->get('users')->row();
									echo $dosen1->nama;
									?>
									<br />
									<?php if ($skripsi->skp_status_dospem_1 == "Diterima") { ?>
										<span class="badge rounded-pill bg-success">Diterima</span>
									<?php } else if ($skripsi->skp_status_dospem_1 == "Ditolak") { ?>
										<span class="badge rounded-pill bg-danger">Ditolak</span>
									<?php } else { ?>
										<span class="badge rounded-pill bg-secondary">Menunggu Persetujuan</span>
									<?php } ?>
								</td>
								<td>
									<?php
									$dosen2 = $this->db->where('id', $skripsi->dospem_2_id)->get('users')->row();
									echo $dosen2->nama;
									?>
									<br />
									<?php if ($skripsi->skp_status_dospem_2 == "Diterima") { ?>
										<span class="badge rounded-pill bg-success">Diterima</span>
									<?php } else if ($skripsi->skp_status_dospem_2 == "Ditolak") { ?>
										<span class="badge rounded-pill bg-danger">Ditolak</span>
									<?php } else { ?>
										<span class="badge rounded-pill bg-secondary">Menunggu Persetujuan</span>
									<?php } ?>
								</td>
								<td>
									<?php if ($skripsi->skp_status_dospem_1 == "Sedang diproses" || $skripsi->skp_status_dospem_2 == "Sedang diproses") { ?>
										<span class="badge rounded-pill bg-secondary">Menunggu Persetujuan</span>
									<?php } else { ?>
										<?php if ($skripsi->skp_status == "Diterima") { ?>
											<span class="badge rounded-pill bg-success">Diterima</span>
										<?php } else if ($skripsi->skp_status == "Ditolak") { ?>
											<span class="badge rounded-pill bg-danger">Ditolak</span>
										<?php } else { ?>
											<span class="badge rounded-pill bg-info">Menunggu Penjadwalan</span>
										<?php } ?>
									<?php } ?>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>

			<?php } ?>



			<?php if ($showAddButton) : ?>
				<a class="btn btn-primary position-absolute top-0 end-0 m-3" href="<?= base_url() ?>registration_skripsi/daftar" style="border-radius: 15px;">
					<i class="ri-add-line"></i>
					Tambah
				</a>
			<?php endif; ?>

		</div>
	</div>
</section>
