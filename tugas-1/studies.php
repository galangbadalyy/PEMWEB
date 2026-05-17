<?php
$isLoggedIn = isset($_SESSION['MEMBER']);
$objStudy = new Study();
$rs = $objStudy->index();

$editId = $_GET['edit'] ?? null;
$rowEdit = null;
if ($isLoggedIn && !empty($editId)) {
  $rowEdit = $objStudy->getStudy($editId);
}
?>

<div class="card border-0 shadow-sm">
  <div class="card-header bg-body d-flex align-items-center justify-content-between">
    <div>
      <div class="fw-semibold">My Studies</div>
      <div class="text-body-secondary small">
        <?php if (!$isLoggedIn): ?>
          Kamu sedang melihat mode <b>guest</b>. Login untuk menambah / mengubah / menghapus data studies.
        <?php else: ?>
          Kamu login sebagai <b><?= htmlspecialchars($_SESSION['MEMBER']['username']) ?></b>. Kamu bisa melakukan CRUD di sini.
        <?php endif; ?>
      </div>
    </div>

    <?php if (!$isLoggedIn): ?>
      <a href="index.php?hal=login" class="btn btn-dark btn-sm">
        <i class="bi bi-box-arrow-in-right me-1"></i> Login
      </a>
    <?php endif; ?>
  </div>

  <div class="card-body">

    <?php if ($isLoggedIn): ?>
      <div class="row g-3">
        <div class="col-lg-5">
          <div class="card border-0 bg-body-tertiary">
            <div class="card-body">
              <div class="fw-semibold mb-1"><?= $rowEdit ? 'Edit Study' : 'Tambah Study' ?></div>
              <div class="text-body-secondary small mb-3">Isi data pendidikan/kelas/pelatihan yang pernah kamu ambil.</div>

              <form method="POST" action="controller/studyController.php">
                <input type="hidden" name="proses" value="<?= $rowEdit ? 'ubah' : 'simpan' ?>">
                <?php if ($rowEdit): ?>
                  <input type="hidden" name="idx" value="<?= htmlspecialchars($rowEdit['id']) ?>">
                <?php endif; ?>

                <div class="mb-2">
                  <label class="form-label small">Judul</label>
                  <input name="title" class="form-control form-control-sm" required
                    value="<?= htmlspecialchars($rowEdit['title'] ?? '') ?>"
                    placeholder="Contoh: Pemrograman Web / S1 Teknik Informatika">
                </div>

                <div class="mb-2">
                  <label class="form-label small">Institusi</label>
                  <input name="institution" class="form-control form-control-sm" required
                    value="<?= htmlspecialchars($rowEdit['institution'] ?? '') ?>"
                    placeholder="Contoh: STT-NF / Kampus / Bootcamp">
                </div>

                <div class="mb-2">
                  <label class="form-label small">Tahun</label>
                  <input name="year" class="form-control form-control-sm" required
                    value="<?= htmlspecialchars($rowEdit['year'] ?? '') ?>"
                    placeholder="Contoh: 2024-2026 atau 2026">
                </div>

                <div class="mb-3">
                  <label class="form-label small">Deskripsi (opsional)</label>
                  <textarea name="description" rows="3" class="form-control form-control-sm"
                    placeholder="Catatan singkat..."><?= htmlspecialchars($rowEdit['description'] ?? '') ?></textarea>
                </div>

                <div class="d-flex gap-2">
                  <button class="btn btn-primary btn-sm">
                    <i class="bi bi-save me-1"></i> <?= $rowEdit ? 'Simpan Perubahan' : 'Tambah' ?>
                  </button>
                  <?php if ($rowEdit): ?>
                    <a class="btn btn-outline-secondary btn-sm" href="index.php?hal=studies">
                      Batal
                    </a>
                  <?php endif; ?>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-7">
    <?php endif; ?>

    <div class="<?= $isLoggedIn ? '' : 'mt-0' ?>">
      <div class="table-responsive">
        <table class="table table-sm align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th style="width: 54px;">#</th>
              <th>Study</th>
              <th style="width: 120px;">Tahun</th>
              <?php if ($isLoggedIn): ?>
                <th style="width: 170px;" class="text-end">Aksi</th>
              <?php endif; ?>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($rs as $row):
              ?>
              <tr>
                <td><?= $no++ ?></td>
                <td>
                  <div class="fw-semibold"><?= htmlspecialchars($row['title']) ?></div>
                  <div class="text-body-secondary small">
                    <?= htmlspecialchars($row['institution']) ?>
                    <?php if (!empty($row['description'])): ?>
                      · <?= htmlspecialchars($row['description']) ?>
                    <?php endif; ?>
                  </div>
                </td>
                <td class="text-nowrap"><?= htmlspecialchars($row['year']) ?></td>

                <?php if ($isLoggedIn): ?>
                  <td class="text-end">
                    <a href="index.php?hal=studies&edit=<?= htmlspecialchars($row['id']) ?>"
                      class="btn btn-outline-primary btn-sm">
                      <i class="bi bi-pencil-square"></i>
                    </a>

                    <form method="POST" action="controller/studyController.php" class="d-inline">
                      <input type="hidden" name="proses" value="hapus">
                      <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                      <button type="submit" class="btn btn-outline-danger btn-sm"
                        onclick="return confirm('Hapus data ini?')">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </td>
                <?php endif; ?>
              </tr>
            <?php endforeach; ?>

            <?php if ($no === 1): ?>
              <tr>
                <td colspan="<?= $isLoggedIn ? 4 : 3 ?>" class="text-center text-body-secondary py-4">
                  Belum ada data studies.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

    <?php if ($isLoggedIn): ?>
        </div>
      </div>
    <?php endif; ?>

  </div>
</div>

