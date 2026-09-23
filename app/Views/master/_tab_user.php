    <!-- Tab User Header -->
    <div class="tab-header-row">
        <h4 class="tab-header-title">
            <i class="bi bi-people me-2" style="color: var(--canva-blue);"></i> Manajemen User
        </h4>
        <button class="canva-btn-add" onclick="userModal.open()">
            <i class="bi bi-plus-lg"></i> Tambah User Baru
        </button>
    </div>

    <!-- Alert flash -->
    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show border-0 rounded-3 mb-3" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <!-- Table -->
    <div class="master-table-wrapper">
        <div class="table-responsive">
            <table class="table table-borderless master-table" id="usersTable">
                <thead>
                    <tr>
                        <th style="width:50px; text-align:center;">#</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Peran</th>
                        <th>Status</th>
                        <th>Terdaftar</th>
                        <th style="width:100px; text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $i => $u): ?>
                    <tr id="user-row-<?= $u['id'] ?>">
                        <td style="text-align:center; color:#9baec8; font-weight:600; font-size:13px;"><?= $i + 1 ?></td>
                        <td>
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div style="
                                    width:34px; height:34px; border-radius:10px;
                                    background:<?= $u['role']==='admin' ? 'linear-gradient(135deg,#3b82f6,#00c4cc)' : 'linear-gradient(135deg,#1b8755,#00c4cc)' ?>;
                                    display:flex; align-items:center; justify-content:center;
                                    font-size:13px; font-weight:700; color:#fff; flex-shrink:0;
                                    box-shadow: 0 4px 10px rgba(59,130,246,0.2);
                                ">
                                    <?= strtoupper(substr($u['username'], 0, 1)) ?>
                                </div>
                                <div>
                                    <span style="font-weight:600; color:#1a1f36; font-size:13.5px;"><?= esc($u['username']) ?></span>
                                    <?php if ($u['id'] === session()->get('user_id')): ?>
                                        <span style="display:inline-block; background:#f0efff; color:#625afa; border-radius:4px; padding:1px 8px; font-size:11px; font-weight:600; margin-left:6px;">Saya</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td style="color:#1a1f36; font-size:13.5px;"><?= esc($u['full_name']) ?></td>
                        <td>
                            <?php if ($u['role'] === 'admin'): ?>
                                <span style="display:inline-flex;align-items:center;gap:4px;background:#fff0f3;color:#df1b41;border-radius:5px;padding:4px 10px;font-size:11.5px;font-weight:600;">
                                    <i class="bi bi-shield-check"></i> Admin
                                </span>
                            <?php else: ?>
                                <span style="display:inline-flex;align-items:center;gap:4px;background:#f0efff;color:#625afa;border-radius:5px;padding:4px 10px;font-size:11.5px;font-weight:600;">
                                    <i class="bi bi-person"></i> User
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($u['is_active']): ?>
                                <span style="display:inline-flex;align-items:center;gap:5px;background:#edfaf3;color:#30b56b;border-radius:5px;padding:4px 10px;font-size:11.5px;font-weight:600;">
                                    <i class="bi bi-circle-fill" style="font-size:7px;"></i> Aktif
                                </span>
                            <?php else: ?>
                                <span style="display:inline-flex;align-items:center;gap:5px;background:#f1f5f9;color:#9baec8;border-radius:5px;padding:4px 10px;font-size:11.5px;font-weight:600;">
                                    <i class="bi bi-circle-fill" style="font-size:7px;"></i> Nonaktif
                                </span>
                            <?php endif; ?>
                        </td>
                        <td style="font-size:13px; color:#6b7c93;">
                            <?= $u['created_at'] ? date('d M Y', strtotime($u['created_at'])) : '-' ?>
                        </td>
                        <td style="white-space: nowrap;">
                            <div style="display:flex; justify-content:center; align-items:center; gap:8px; flex-wrap: nowrap;">
                                <!-- Edit Button -->
                                <button class="user-action-btn user-edit-btn"
                                        title="Edit"
                                        onclick='userModal.openEdit(<?= json_encode($u) ?>)'>
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                                <!-- Delete Button (hidden for own account) -->
                                <?php if ($u['id'] !== session()->get('user_id')): ?>
                                <button class="user-action-btn user-delete-btn"
                                        title="Hapus"
                                        onclick="userModal.confirmDelete(<?= $u['id'] ?>, '<?= esc($u['username']) ?>')">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="7" style="text-align:center; padding:40px; color:#9baec8;">
                            <i class="bi bi-people" style="font-size:36px; display:block; margin-bottom:10px;"></i>
                            <div style="font-weight:600; font-size:14px; color:#6b7c93;">Belum ada user terdaftar</div>
                            <div style="font-size:13px; margin-top:4px;">Klik tombol <strong>Tambah User Baru</strong> untuk mulai menambahkan.</div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ══ User Modal (Add / Edit) ══ -->
    <div id="userModalOverlay" style="
        display:none;
        position:fixed; inset:0; z-index:3000;
        background:rgba(26,31,54,0.45);
        backdrop-filter:blur(4px);
        -webkit-backdrop-filter:blur(4px);
        align-items:center; justify-content:center; padding:20px;
    ">
        <div style="
            background:#fff;
            border-radius:14px;
            border:1px solid #e6ebf1;
            box-shadow:0 15px 35px rgba(60,66,87,0.15), 0 5px 15px rgba(0,0,0,0.08);
            width:100%; max-width:460px;
            animation: umIn 0.2s cubic-bezier(0.16,1,0.3,1);
        ">
            <!-- Header -->
            <div style="padding:20px 24px 16px; border-bottom:1px solid #e6ebf1; display:flex; align-items:center; justify-content:space-between;">
                <h3 id="userModalTitle" style="margin:0; font-size:17px; font-weight:700; color:#1a1f36; letter-spacing:-0.2px;">Tambah User Baru</h3>
                <button onclick="userModal.close()" style="
                    width:28px; height:28px; border-radius:6px;
                    border:1px solid #e6ebf1; background:#fff;
                    color:#6b7c93; cursor:pointer; font-size:16px;
                    display:flex; align-items:center; justify-content:center;
                    transition:all 0.15s;
                " onmouseover="this.style.background='#f6f9fc';this.style.color='#df1b41';"
                   onmouseout="this.style.background='#fff';this.style.color='#6b7c93';">
                    <i class="bi bi-x"></i>
                </button>
            </div>

            <!-- Body -->
            <form id="userForm" autocomplete="off">
                <input type="hidden" id="umUserId" value="">
                <div style="padding:20px 24px;">

                    <!-- Username (readonly on edit) -->
                    <div class="um-form-group">
                        <label class="um-label">Username <span style="color:#df1b41;">*</span></label>
                        <input type="text" id="umUsername" class="um-input" placeholder="Masukkan username..." required>
                    </div>

                    <!-- Full Name -->
                    <div class="um-form-group">
                        <label class="um-label">Nama Lengkap <span style="color:#df1b41;">*</span></label>
                        <input type="text" id="umFullName" class="um-input" list="role_list" placeholder="Masukkan nama lengkap..." required autocomplete="off">
                        <datalist id="role_list">
                            <option value="Administrator"></option>
                            <option value="PPIC"></option>
                            <option value="QC Plant 1"></option>
                            <option value="QC Plant 2"></option>
                        </datalist>
                    </div>

                    <!-- Password -->
                    <div class="um-form-group" id="umPasswordGroup">
                        <label class="um-label" id="umPasswordLabel">Password <span style="color:#df1b41;">*</span></label>
                        <input type="password" id="umPassword" class="um-input" placeholder="Masukkan password...">
                        <p id="umPasswordHint" style="display:none; margin:5px 0 0; font-size:11.5px; color:#625afa;">
                            <i class="bi bi-info-circle"></i> Kosongkan jika tidak ingin mengubah password.
                        </p>
                    </div>

                    <!-- Role & Status -->
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                        <div>
                            <label class="um-label">Peran (Role) <span style="color:#df1b41;">*</span></label>
                            <select id="umRole" class="um-input" style="height:40px; cursor:pointer;">
                                <option value="user">User Biasa</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>
                        <div>
                            <label class="um-label">Status Akun</label>
                            <select id="umIsActive" class="um-input" style="height:40px; cursor:pointer;">
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    <!-- Alert area -->
                    <div id="umAlert" style="display:none; margin-top:14px; padding:10px 14px; border-radius:7px; font-size:13px;"></div>
                </div>

                <!-- Footer -->
                <div style="padding:14px 24px 20px; border-top:1px solid #e6ebf1; display:flex; justify-content:flex-end; gap:8px;">
                    <button type="button" onclick="userModal.close()" class="stripe-btn-cancel" style="height:38px; padding:0 18px; border:1px solid #cfd7df; border-radius:6px; background:#fff; color:#1a1f36; font-size:13.5px; font-weight:500; cursor:pointer;">
                        Batal
                    </button>
                    <button type="submit" id="umSaveBtn" class="stripe-btn-save" style="height:38px; padding:0 20px; border:1px solid #4f46e5; border-radius:6px; background:#625afa; color:#fff; font-size:13.5px; font-weight:600; cursor:pointer;">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
    @keyframes umIn {
        from { opacity:0; transform:translateY(10px) scale(0.98); }
        to   { opacity:1; transform:translateY(0) scale(1); }
    }
    .user-action-btn {
        width: 32px; height: 32px;
        border-radius: 8px;
        border: 1px solid #e6ebf1;
        background: #fff;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.15s ease;
    }
    .user-edit-btn  { color: #625afa; }
    .user-edit-btn:hover  { background: #f0efff; border-color: rgba(98,90,250,0.3); color: #4f46e5; }
    .user-delete-btn { color: #df1b41; }
    .user-delete-btn:hover { background: #fff0f3; border-color: rgba(223,27,65,0.3); color: #c41636; }

    .um-form-group { margin-bottom: 16px; }
    .um-label {
        display: block;
        font-size: 12px; font-weight: 600;
        color: #6b7c93;
        text-transform: uppercase; letter-spacing: 0.4px;
        margin-bottom: 6px;
    }
    .um-input {
        width: 100%; height: 40px;
        padding: 0 12px;
        border: 1px solid #cfd7df;
        border-radius: 6px;
        background: #fff;
        color: #1a1f36;
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        outline: none;
        transition: border-color 0.15s, box-shadow 0.15s;
        box-shadow: 0 1px 2px rgba(60,66,87,0.04);
        box-sizing: border-box;
    }
    .um-input:focus { border-color: #625afa; box-shadow: 0 0 0 3px rgba(98,90,250,0.15); }
    .um-input[readonly], .um-input[disabled] { background: #f6f9fc; color: #9baec8; cursor: not-allowed; }
    </style>

    <script>
    // ══════════════════════════════════════════
    //  User Modal Controller
    // ══════════════════════════════════════════
    const userModal = (function() {
        const BASE = '<?= base_url() ?>';
        const overlay = document.getElementById('userModalOverlay');
        const form    = document.getElementById('userForm');

        function show() {
            overlay.style.display = 'flex';
            document.getElementById('umAlert').style.display = 'none';
        }

        function close() {
            overlay.style.display = 'none';
            form.reset();
            document.getElementById('umUserId').value = '';
            document.getElementById('umAlert').style.display = 'none';
        }

        // Close when clicking outside the box
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) close();
        });

        // Open for ADD
        function open() {
            document.getElementById('userModalTitle').textContent = 'Tambah User Baru';
            document.getElementById('umUserId').value = '';
            document.getElementById('umUsername').value = '';
            document.getElementById('umUsername').readOnly = false;
            document.getElementById('umUsername').style.background = '';
            document.getElementById('umFullName').value = '';
            document.getElementById('umPassword').value = '';
            document.getElementById('umPassword').required = true;
            document.getElementById('umPasswordLabel').innerHTML = 'Password <span style="color:#df1b41;">*</span>';
            document.getElementById('umPasswordHint').style.display = 'none';
            document.getElementById('umRole').value = 'user';
            document.getElementById('umIsActive').value = '1';
            show();
            setTimeout(() => document.getElementById('umUsername').focus(), 100);
        }

        // Open for EDIT
        function openEdit(u) {
            document.getElementById('userModalTitle').textContent = 'Edit User';
            document.getElementById('umUserId').value = u.id;
            document.getElementById('umUsername').value = u.username;
            document.getElementById('umUsername').readOnly = true;
            document.getElementById('umUsername').style.background = '#f6f9fc';
            document.getElementById('umFullName').value = u.full_name;
            document.getElementById('umPassword').value = '';
            document.getElementById('umPassword').required = false;
            document.getElementById('umPasswordLabel').innerHTML = 'Password (Opsional)';
            document.getElementById('umPasswordHint').style.display = 'block';
            document.getElementById('umRole').value = u.role;
            document.getElementById('umIsActive').value = u.is_active ? '1' : '0';
            show();
            setTimeout(() => document.getElementById('umFullName').focus(), 100);
        }

        // Confirm delete with SweetAlert2
        function confirmDelete(id, username) {
            if (typeof Swal === 'undefined') {
                if (!confirm('Hapus user "' + username + '"? Data tidak bisa dikembalikan.')) return;
                doDelete(id);
                return;
            }
            Swal.fire({
                title: 'Hapus User?',
                html: 'User <strong>' + username + '</strong> akan dihapus secara permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#df1b41',
                cancelButtonColor: '#cfd7df',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: { popup: 'swal2-popup' }
            }).then(r => { if (r.isConfirmed) doDelete(id); });
        }

        function doDelete(id) {
            fetch(BASE + 'users/delete', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: 'id=' + encodeURIComponent(id)
            })
            .then(r => r.json())
            .then(res => {
                if (res.success) {
                    // Remove row from DOM
                    const row = document.getElementById('user-row-' + id);
                    if (row) row.remove();
                    showToast('User berhasil dihapus.', 'success');
                } else {
                    showToast(res.message || 'Gagal menghapus.', 'error');
                }
            })
            .catch(() => showToast('Terjadi kesalahan server.', 'error'));
        }

        function showAlert(msg, type) {
            const el = document.getElementById('umAlert');
            el.style.display = 'block';
            if (type === 'error') {
                el.style.background = '#fff0f3';
                el.style.border = '1px solid rgba(223,27,65,0.2)';
                el.style.color = '#df1b41';
            } else {
                el.style.background = '#edfaf3';
                el.style.border = '1px solid rgba(48,181,107,0.2)';
                el.style.color = '#30b56b';
            }
            el.innerHTML = '<i class="bi bi-' + (type==='error'?'exclamation-circle':'check-circle') + ' me-2"></i>' + msg;
        }

        function showToast(msg, type) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({ icon: type, title: msg, toast: true, position: 'top-end', showConfirmButton: false, timer: 2500 });
            } else {
                alert(msg);
            }
        }

        // Form submit handler
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const id       = document.getElementById('umUserId').value;
            const username = document.getElementById('umUsername').value.trim();
            const fullName = document.getElementById('umFullName').value.trim();
            const password = document.getElementById('umPassword').value;
            const role     = document.getElementById('umRole').value;
            const isActive = document.getElementById('umIsActive').value;

            const btn = document.getElementById('umSaveBtn');
            const origText = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-arrow-clockwise"></i> Menyimpan...';

            const isEdit = id !== '';
            const url    = BASE + (isEdit ? 'users/update' : 'users/create');

            let body = `full_name=${encodeURIComponent(fullName)}&role=${encodeURIComponent(role)}&is_active=${encodeURIComponent(isActive)}&password=${encodeURIComponent(password)}`;
            if (isEdit) {
                body += `&id=${encodeURIComponent(id)}`;
            } else {
                body += `&username=${encodeURIComponent(username)}`;
            }

            fetch(url, {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: body
            })
            .then(r => r.json())
            .then(res => {
                if (res.success) {
                    close();
                    showToast(res.message || 'Berhasil!', 'success');
                    // Reload page to refresh table
                    setTimeout(() => location.reload(), 800);
                } else {
                    showAlert(res.message || 'Gagal menyimpan.', 'error');
                }
            })
            .catch(() => showAlert('Terjadi kesalahan server.', 'error'))
            .finally(() => { btn.disabled = false; btn.innerHTML = origText; });
        });

        return { open, openEdit, confirmDelete, close };
    })();
    </script>
