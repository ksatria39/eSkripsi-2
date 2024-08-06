<section class="section">
	<div class="card">
		<div class="card-body">

			<?php if ($this->session->flashdata('error')) : ?>
				<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
					<?php echo $this->session->flashdata('error'); ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php endif; ?>

			<form method="post" action="<?php echo base_url('title/set_title'); ?>">

				<input type="hidden" value="<?= $judul->id ?>" name="title_id" id="title_id">

				<div class="row mb-3 mt-3">
					<label for="inputText" class="col-sm-2 col-form-label">Judul</label>
					<div class="col-sm-10">
						<textarea class="form-control" name="judul" id="judul" style="height: 100px" placeholder="Masukkan Judul"><?= $judul->judul ?></textarea>
					</div>
				</div>

				<div class="row mb-3">
					<label class="col-sm-2 col-form-label">Bidang Penelitian</label>
					<div class="col-sm-10">
						<select class="form-select" name="bidang_id" id="bidang_id" aria-label="Default select example">
							<?php foreach ($research_area as $area) : ?>
								<option value="<?= $area['id']; ?>" <?= set_select('bidang_id', $area['id']); ?> <?php if ($area['id'] == $judul->bidang_id) echo 'selected'; ?>><?= $area['nama']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="row mb-3">
					<label class="col-sm-2 col-form-label">Pembimbing 1</label>
					<div class="col-sm-10">
						<select class="form-select" name="dospem_1_id" id="dospem_1_id" aria-label="Default select example">
							<?php foreach ($dosen as $dosen) : ?>
								<option value="<?= $dosen['id_dosen']; ?>" <?= set_select('dospem_1_id', $dosen['id_dosen']); ?> <?php if ($dosen['id_dosen'] == $judul->dospem_1_id) echo 'selected'; ?>><?= $dosen['nama_dosen']; ?> (<?= $dosen['jumlah_mahasiswa']; ?>)</option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>


				<div class="row mb-3">
					<label class="col-sm-2 col-form-label">Pembimbing 2</label>
					<div class="col-sm-10">
						<select class="form-select" name="dospem_2_id" id="dospem_2_id" aria-label="Default select example">
							<?php foreach ($dosen2 as $dosen2) : ?>
								<option value="<?= $dosen2['id_dosen']; ?>" <?= set_select('dospem_2_id', $dosen2['id_dosen']); ?> <?php if ($dosen2['id_dosen'] == $judul->dospem_2_id) echo 'selected'; ?>><?= $dosen2['nama_dosen']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="row mb-3">
					<label class="col-sm-2 col-form-label">Status</label>
					<div class="col-sm-10">
						<select class="form-select" name="title_status" id="title_status" aria-label="Default select example">
							<option value="Diterima" <?php if ($judul->status == "Diterima") {
															echo "selected";
														} else{} ?>>Diterima</option>
							<option value="Ditolak" <?php if ($judul->status == "Ditolak") {
														echo "selected";
													} else{} ?>>Ditolak</option>
						</select>
					</div>
				</div>

				<div class="col-sm-10" align="center">
					<button type="submit" class="btn btn-primary">Sunting</button>
				</div>

			</form>
		</div>
	</div>
</section>