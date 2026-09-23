<?php include APPPATH . 'Views/templates/header.php'; ?>

<div class="page-wrapper">
    <!-- Page Header -->
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:20px;">
        <div>
            <h1 style="font-size:20px; font-weight:700; color:#1a2332; margin:0; letter-spacing:-0.3px;">
                <i class="bi bi-people" style="color:#6366f1; margin-right:8px;"></i>Manajemen User
            </h1>
            <p style="font-size:13px; color:#64748b; margin:4px 0 0;">Kelola akun pengguna sistem — Admin Only</p>
        </div>
        <button id="btnAddUser" class="btn-primary-action" onclick="openModal()">
            <i class="bi bi-person-plus"></i> Tambah User
        </button>
    </div>

    <!-- Alert flash -->
    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert-flash error">
        <i class="bi bi-exclamation-circle-fill"></i>
        <?= session()->getFlashdata('error') ?>
    </div>
    <?php endif; ?>

    <!-- Table Card -->
    <div class="card-panel">
        <div class="card-panel-header" style="padding:16px 20px; border-bottom:1px solid #e2e8f0; display:flex; align-items:center; gap:8px;">
            <i class="bi bi-table" style="color:#6366f1;"></i>
            <span style="font-weight:600; font-size:14px; color:#1a2332;">Daftar User</span>
            <span style="margin-left:auto; font-size:12px; color:#94a3b8;"><?= count($users) ?> user terdaftar</span>
        </div>
        <div style="overflow-x:auto;">
            <table class="data-table" id="usersTable" style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr>
                        <th style="width:50px;">#</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th style="width:130px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $i => $u): ?>
                    <tr id="row-<?= $u['id'] ?>">
                        <td style="text-align:center; color:#94a3b8; font-size:12px;"><?= $i + 1 ?></td>
                        <td>
                            <div style="display:flex; align-items:center; gap:8px;">
                                <div class="user-avatar <?= $u['role'] === 'admin' ? 'avatar-admin' : 'avatar-user' ?>">
                                    <?= strtoupper(substr($u['username'], 0, 1)) ?>
                                </div>
                                <span style="font-weight:500; color:#1a2332;"><?= esc($u['username']) ?></span>
                                <?php if ($u['id'] === session()->get('user_id')): ?>
                                    <span class="badge-self">Saya</span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td style="color:#475569;"><?= esc($u['full_name']) ?></td>
                        <td>
                            <?php if ($u['role'] === 'admin'): ?>
                                <span class="badge-role badge-admin"><i class="bi bi-shield-check"></i> Admin</span>
                            <?php else: ?>
                                <span class="badge-role badge-user"><i class="bi bi-person"></i> User</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($u['is_active']): ?>
                                <span class="badge-status active"><i class="bi bi-circle-fill" style="font-size:8px;"></i> Aktif</span>
                            <?php else: ?>
                                <span class="badge-status inactive"><i class="bi bi-circle-fill" style="font-size:8px;"></i> Nonaktif</span>
                            <?php endif; ?>
                        </td>
                        <td style="font-size:12px; color:#94a3b8;">
                            <?= $u['created_at'] ? date('d M Y', strtotime($u['created_at'])) : '-' ?>
                        </td>
                        <td>
                            <div style="display:flex; gap:6px;">
                                <button class="btn-icon btn-edit" title="Edit" onclick='openEditModal(<?= json_encode($u) ?>)'>
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <?php if ($u['id'] !== session()->get('user_id')): ?>
                                <button class="btn-icon btn-del" title="Hapus" onclick="confirmDelete(<?= $u['id'] ?>, '<?= esc($u['username']) ?>')">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="7" style="text-align:center; padding:40px; color:#94a3b8;">
                            <i class="bi bi-inbox" style="font-size:24px; display:block; margin-bottom:8px;"></i>
                            Belum ada user terdaftar
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ── Modal Tambah/Edit User ─────────────────────────────────────────── -->
<div id="userModal" class="modal-overlay" style="display:none;">
    <div class="modal-box">
        <div class="modal-header">
            <span id="modalTitle" style="font-weight:700; font-size:15px; color:#1a2332;">Tambah User</span>
            <button class="modal-close" onclick="closeModal()"><i class="bi bi-x-lg"></i></button>
        </div>
        <form id="userForm">
            <input type="hidden" id="userId" name="id" value="">
            <div class="form-row">
                <div class="form-grp" id="usernameGroup">
                    <label class="form-lbl">Username <span style="color:#ef4444;">*</span></label>
                    <input type="text" id="inputUsername" name="username" class="form-inp" placeholder="min. 2 karakter" required>
                </div>
                <div class="form-grp">
                    <label class="form-lbl">Nama Lengkap <span style="color:#ef4444;">*</span></label>
                    <input type="text" id="inputFullName" name="full_name" class="form-inp" placeholder="Nama lengkap" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-grp">
                    <label class="form-lbl">Password <span id="pwdRequired" style="color:#ef4444;">*</span></label>
                    <input type="password" id="inputPassword" name="password" class="form-inp" placeholder="min. 3 karakter">
                    <small id="pwdHint" style="color:#94a3b8; font-size:11px;"></small>
                </div>
                <div class="form-grp">
                    <label class="form-lbl">Role</label>
                    <select id="inputRole" name="role" class="form-inp">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
            <div class="form-grp">
                <label class="form-lbl">Status</label>
                <select id="inputStatus" name="is_active" class="form-inp">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

            <!-- Alert modal -->
            <div id="modalAlert" style="display:none;" class="modal-alert"></div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn-save" id="btnSave">
                    <i class="bi bi-floppy"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ── Confirm Delete Modal ───────────────────────────────────────────── -->
<div id="deleteModal" class="modal-overlay" style="display:none;">
    <div class="modal-box" style="max-width:380px;">
        <div style="text-align:center; padding:20px 10px;">
            <div style="width:56px; height:56px; background:rgba(239,68,68,0.12); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
                <i class="bi bi-trash" style="font-size:24px; color:#ef4444;"></i>
            </div>
            <h3 style="font-size:16px; font-weight:700; color:#1a2332; margin:0 0 8px;">Hapus User?</h3>
            <p style="font-size:13.5px; color:#64748b; margin:0;">
                User <strong id="deleteUserName"></strong> akan dihapus permanen.<br>Tindakan ini tidak bisa dibatalkan.
            </p>
        </div>
        <div style="display:flex; gap:10px; padding:0 20px 20px;">
            <button class="btn-cancel" style="flex:1;" onclick="closeDeleteModal()">Batal</button>
            <button class="btn-del-confirm" style="flex:1;" id="btnConfirmDel">
                <i class="bi bi-trash"></i> Ya, Hapus
            </button>
        </div>
    </div>
</div>

<!-- ── Toast ──────────────────────────────────────────────────────────── -->
<div id="toast" class="toast-notif" style="display:none;"></div>

<style>
/* ── Page styles ── */
.page-wrapper { padding:20px 20px 40px; min-height:calc(100vh - 52px); background:#e8ecf2; }
.btn-primary-action {
    display:inline-flex; align-items:center; gap:7px;
    padding:9px 18px; border:none; border-radius:9px;
    background:linear-gradient(135deg,#3b82f6,#6366f1);
    color:#fff; font-size:13.5px; font-weight:600;
    font-family:'Inter',sans-serif; cursor:pointer;
    box-shadow:0 3px 12px rgba(99,102,241,0.3);
    transition:all 0.2s;
}
.btn-primary-action:hover { transform:translateY(-1px); box-shadow:0 6px 18px rgba(99,102,241,0.4); }
.alert-flash {
    display:flex; align-items:center; gap:8px;
    padding:11px 16px; border-radius:10px; margin-bottom:16px; font-size:13px;
}
.alert-flash.error { background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.25); color:#dc2626; }
.card-panel { background:#fff; border-radius:14px; box-shadow:0 2px 12px rgba(0,0,0,0.06); overflow:hidden; }
.card-panel-header { }
.data-table thead tr { background:#f8fafc; }
.data-table th {
    padding:11px 16px; font-size:12px; font-weight:600;
    color:#64748b; text-transform:uppercase; letter-spacing:0.5px;
    border-bottom:1px solid #e2e8f0; white-space:nowrap;
}
.data-table td { padding:12px 16px; font-size:13.5px; border-bottom:1px solid #f1f5f9; vertical-align:middle; }
.data-table tbody tr:last-child td { border-bottom:none; }
.data-table tbody tr:hover { background:#f8fafc; }
.user-avatar {
    width:30px; height:30px; border-radius:50%;
    display:flex; align-items:center; justify-content:center;
    font-size:12px; font-weight:700; color:#fff; flex-shrink:0;
}
.avatar-admin { background:linear-gradient(135deg,#3b82f6,#6366f1); }
.avatar-user  { background:linear-gradient(135deg,#10b981,#059669); }
.badge-self {
    font-size:10px; padding:2px 7px; border-radius:20px;
    background:rgba(99,102,241,0.1); color:#6366f1; font-weight:600;
}
.badge-role {
    display:inline-flex; align-items:center; gap:4px;
    font-size:11.5px; padding:3px 9px; border-radius:20px; font-weight:600;
}
.badge-admin { background:rgba(59,130,246,0.1); color:#2563eb; }
.badge-user  { background:rgba(16,185,129,0.1); color:#059669; }
.badge-status {
    display:inline-flex; align-items:center; gap:5px;
    font-size:11.5px; padding:3px 9px; border-radius:20px; font-weight:600;
}
.badge-status.active   { background:rgba(34,197,94,0.1); color:#16a34a; }
.badge-status.inactive { background:rgba(100,116,139,0.1); color:#64748b; }
.btn-icon {
    width:32px; height:32px; border:none; border-radius:7px;
    display:inline-flex; align-items:center; justify-content:center;
    cursor:pointer; font-size:13px; transition:all 0.15s;
}
.btn-edit { background:rgba(99,102,241,0.1); color:#6366f1; }
.btn-edit:hover { background:rgba(99,102,241,0.2); }
.btn-del  { background:rgba(239,68,68,0.1); color:#ef4444; }
.btn-del:hover  { background:rgba(239,68,68,0.2); }

/* ── Modal ── */
.modal-overlay {
    position:fixed; inset:0; background:rgba(0,0,0,0.45);
    z-index:9000; display:flex; align-items:center; justify-content:center;
    backdrop-filter:blur(3px); animation:fadeIn 0.2s ease;
}
@keyframes fadeIn { from{opacity:0} to{opacity:1} }
.modal-box {
    background:#fff; border-radius:16px; padding:0;
    width:100%; max-width:520px; margin:16px;
    box-shadow:0 20px 60px rgba(0,0,0,0.25);
    animation:slideUp 0.25s cubic-bezier(0.16,1,0.3,1);
}
@keyframes slideUp { from{transform:translateY(20px);opacity:0} to{transform:translateY(0);opacity:1} }
.modal-header {
    display:flex; align-items:center; justify-content:space-between;
    padding:18px 20px; border-bottom:1px solid #e2e8f0;
}
.modal-close {
    background:none; border:none; cursor:pointer; color:#94a3b8;
    font-size:14px; padding:4px; border-radius:5px; line-height:1;
    transition:all 0.15s;
}
.modal-close:hover { color:#1a2332; background:#f1f5f9; }
.modal-footer {
    display:flex; justify-content:flex-end; gap:10px;
    padding:16px 20px; border-top:1px solid #e2e8f0;
}
.form-row { display:grid; grid-template-columns:1fr 1fr; gap:14px; padding:16px 20px 0; }
.form-grp { padding:0 20px 14px; }
.form-grp:first-child:not(:last-child) { padding-bottom:0; }
.form-row .form-grp { padding:0; }
.form-row + .form-grp { padding:14px 20px 0; }
.form-lbl { display:block; font-size:12px; font-weight:600; color:#64748b; margin-bottom:5px; letter-spacing:0.3px; text-transform:uppercase; }
.form-inp {
    width:100%; padding:9px 12px; border:1px solid #e2e8f0; border-radius:8px;
    font-size:13.5px; font-family:'Inter',sans-serif; color:#1a2332;
    background:#f8fafc; outline:none; transition:all 0.15s;
}
.form-inp:focus { border-color:#6366f1; background:#fff; box-shadow:0 0 0 3px rgba(99,102,241,0.1); }
.modal-alert { padding:10px 14px; border-radius:8px; font-size:13px; margin:0 20px 4px; }
.modal-alert.error { background:rgba(239,68,68,0.08); border:1px solid rgba(239,68,68,0.2); color:#dc2626; }
.modal-alert.success { background:rgba(34,197,94,0.08); border:1px solid rgba(34,197,94,0.2); color:#16a34a; }
.btn-cancel {
    padding:9px 20px; border:1px solid #e2e8f0; border-radius:8px;
    background:#fff; color:#64748b; font-size:13.5px; font-weight:500;
    font-family:'Inter',sans-serif; cursor:pointer; transition:all 0.15s;
}
.btn-cancel:hover { background:#f1f5f9; border-color:#cbd5e1; }
.btn-save {
    padding:9px 20px; border:none; border-radius:8px;
    background:linear-gradient(135deg,#3b82f6,#6366f1);
    color:#fff; font-size:13.5px; font-weight:600;
    font-family:'Inter',sans-serif; cursor:pointer;
    box-shadow:0 2px 10px rgba(99,102,241,0.3); transition:all 0.15s;
}
.btn-save:hover { box-shadow:0 4px 14px rgba(99,102,241,0.4); }
.btn-del-confirm {
    padding:9px 20px; border:none; border-radius:8px;
    background:linear-gradient(135deg,#ef4444,#dc2626);
    color:#fff; font-size:13.5px; font-weight:600;
    font-family:'Inter',sans-serif; cursor:pointer;
    box-shadow:0 2px 8px rgba(239,68,68,0.3); transition:all 0.15s;
    display:flex; align-items:center; justify-content:center; gap:6px;
}
.btn-del-confirm:hover { box-shadow:0 4px 14px rgba(239,68,68,0.4); }

/* ── Toast ── */
.toast-notif {
    position:fixed; bottom:24px; right:24px; z-index:9999;
    padding:12px 20px; border-radius:10px;
    font-family:'Inter',sans-serif; font-size:13.5px; font-weight:500;
    display:flex; align-items:center; gap:8px;
    box-shadow:0 8px 30px rgba(0,0,0,0.15);
    animation:toastIn 0.3s cubic-bezier(0.16,1,0.3,1);
}
@keyframes toastIn { from{transform:translateY(20px);opacity:0} to{transform:translateY(0);opacity:1} }
.toast-notif.success { background:#fff; border-left:4px solid #22c55e; color:#166534; }
.toast-notif.error   { background:#fff; border-left:4px solid #ef4444; color:#991b1b; }
</style>

<script>
const BASE = '<?= base_url() ?>';
let deleteTargetId = null;

// ── Toast ──────────────────────────────────────────────────────────────
function showToast(msg, type = 'success') {
    const t = document.getElementById('toast');
    t.className = `toast-notif ${type}`;
    t.innerHTML = type === 'success'
        ? '<i class="bi bi-check-circle-fill"></i> ' + msg
        : '<i class="bi bi-x-circle-fill"></i> ' + msg;
    t.style.display = 'flex';
    setTimeout(() => { t.style.display = 'none'; }, 3500);
}

// ── Modal Add ──────────────────────────────────────────────────────────
function openModal() {
    document.getElementById('modalTitle').textContent = 'Tambah User';
    document.getElementById('userForm').reset();
    document.getElementById('userId').value = '';
    document.getElementById('usernameGroup').style.display = '';
    document.getElementById('inputUsername').required = true;
    document.getElementById('inputPassword').required = true;
    document.getElementById('pwdRequired').style.display = '';
    document.getElementById('pwdHint').textContent = '';
    document.getElementById('modalAlert').style.display = 'none';
    document.getElementById('userModal').style.display = 'flex';
}

// ── Modal Edit ─────────────────────────────────────────────────────────
function openEditModal(user) {
    document.getElementById('modalTitle').textContent = 'Edit User: ' + user.username;
    document.getElementById('userId').value = user.id;
    document.getElementById('inputUsername').value = user.username;
    document.getElementById('inputFullName').value = user.full_name;
    document.getElementById('inputRole').value = user.role;
    document.getElementById('inputStatus').value = user.is_active;
    document.getElementById('inputPassword').value = '';
    document.getElementById('inputPassword').required = false;
    document.getElementById('pwdRequired').style.display = 'none';
    document.getElementById('pwdHint').textContent = 'Kosongkan jika tidak ingin mengubah password.';
    document.getElementById('usernameGroup').style.display = 'none';
    document.getElementById('modalAlert').style.display = 'none';
    document.getElementById('userModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('userModal').style.display = 'none';
}

// ── Form Submit ────────────────────────────────────────────────────────
document.getElementById('userForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const id      = document.getElementById('userId').value;
    const url     = id ? BASE + 'users/update' : BASE + 'users/create';
    const data    = new FormData(this);
    const btn     = document.getElementById('btnSave');
    const alert   = document.getElementById('modalAlert');

    btn.disabled = true;
    btn.innerHTML = '<i class="bi bi-arrow-clockwise" style="animation:spin 0.8s linear infinite;display:inline-block;"></i> Menyimpan...';

    fetch(url, { method: 'POST', body: data })
        .then(r => r.json())
        .then(res => {
            if (res.success) {
                closeModal();
                showToast(res.message || 'Berhasil!', 'success');
                setTimeout(() => location.reload(), 1000);
            } else {
                alert.className = 'modal-alert error';
                alert.textContent = res.message || 'Terjadi kesalahan.';
                alert.style.display = 'block';
            }
        })
        .catch(() => {
            alert.className = 'modal-alert error';
            alert.textContent = 'Gagal menghubungi server.';
            alert.style.display = 'block';
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-floppy"></i> Simpan';
        });
});

// ── Delete ─────────────────────────────────────────────────────────────
function confirmDelete(id, username) {
    deleteTargetId = id;
    document.getElementById('deleteUserName').textContent = username;
    document.getElementById('deleteModal').style.display = 'flex';
}
function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
    deleteTargetId = null;
}
document.getElementById('btnConfirmDel').addEventListener('click', function() {
    if (!deleteTargetId) return;
    const data = new FormData();
    data.append('id', deleteTargetId);
    this.disabled = true;
    fetch(BASE + 'users/delete', { method: 'POST', body: data })
        .then(r => r.json())
        .then(res => {
            closeDeleteModal();
            if (res.success) {
                showToast(res.message, 'success');
                document.getElementById('row-' + deleteTargetId)?.remove();
            } else {
                showToast(res.message, 'error');
            }
        })
        .finally(() => { this.disabled = false; });
});

// Close modals on overlay click
document.querySelectorAll('.modal-overlay').forEach(o => {
    o.addEventListener('click', function(e) { if (e.target === this) { this.style.display = 'none'; } });
});
</script>
<style>@keyframes spin { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }</style>

<?php include APPPATH . 'Views/templates/footer.php'; ?>
