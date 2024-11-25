<?php
// Koneksi ke database
require_once 'koneksi.php';

// Tangani notifikasi update sukses
if (isset($_GET['update']) && $_GET['update'] === 'success') {
    echo '<div class="alert alert-success">Data berhasil diperbarui.</div>';
}

// Tentukan jumlah data per halaman
$perPage = 7;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $perPage;

// Query untuk menghitung total data pada tabel contact
$queryCount = "SELECT COUNT(*) FROM contact";
$stmtCount = $conn->prepare($queryCount);
$stmtCount->execute();
$totalContacts = $stmtCount->fetchColumn();
$totalPages = ceil($totalContacts / $perPage);

// Query untuk mengambil data dari tabel contact dengan pagination
$query = "SELECT id, name, email, message, created_at FROM contact LIMIT :offset, :perPage";
$stmt = $conn->prepare($query);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Jika logout diakses, akhiri sesi dan arahkan ke halaman login
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php"); // Ganti dengan halaman login Anda
    exit();
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengguna - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css?family=Quantico:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            color: #333;
            background-color: #f4f6f9;
            margin: 0;
        }

        .sidebar {
            width: 240px;
            background-color: #152732;
            color: #ffffff;
            height: 100vh;
            padding-top: 30px;
            position: fixed;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            font-family: 'Quantico', sans-serif;
            font-size: 22px;
            text-align: center;
            color: #ffffff;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .sidebar a {
            color: #b0bec5;
            padding: 15px 20px;
            text-decoration: none;
            display: block;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #009603;
            color: #ffffff;
        }

        .sidebar i {
            margin-right: 10px;
        }

        .main-content {
            margin-left: 240px;
            padding: 20px;
        }

        .header h1 {
            font-family: 'Quantico', sans-serif;
            font-weight: 700;
            color: #333;
        }

        /* Tabel Pengguna */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        th {
            background-color: #152732;
            color: #fff;
            text-align: left;
            font-weight: 600;
        }

        td {
            text-align: left;
        }

        .action-buttons button {
            margin-right: 5px;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            color: #fff;
            border-radius: 4px;
        }

        .edit-btn {
            background-color: #009603;
        }

        .delete-btn {
            background-color: #f44336;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            padding: 10px;
            margin-top: 10px;
        }

        .pagination a {
            padding: 8px 12px;
            margin: 0 4px;
            border-radius: 5px;
            background-color: #ddd;
            color: #333;
            text-decoration: none;
        }

        .pagination a.active,
        .pagination a:hover {
            background-color: #009603;
            color: #fff;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            /* Pastikan modal menggunakan flexbox */
            align-items: center;
            /* Vertikal center */
            justify-content: center;
            /* Horizontal center */
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            max-width: 90%;
            animation: fadeIn 0.4s ease;
            box-sizing: border-box;
            /* Pastikan padding tidak menambah lebar */
        }

        .modal-header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .modal-body label {
            display: block;
            font-weight: 600;
            margin-top: 10px;
        }

        .modal-body input[type="text"],
        .modal-body input[type="email"],
        .modal-body input[type="tel"],
        .modal-body input[type="bio"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
            box-sizing: border-box;
            /* Pastikan padding tidak menambah lebar */
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            margin-top: 15px;
        }

        .modal-footer button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
        }

        .save-btn {
            background-color: #009603;
            color: #fff;
            margin-right: 10px;
        }

        .cancel-btn {
            background-color: #f44336;
            color: #fff;
        }


        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
            background-color: #fff;
        }
    </style>

    <script>
        // Fungsi Logout dengan konfirmasi
        function logout() {
            if (confirm("Apakah anda yakin ingin keluar?")) {
                window.location.href = 'adminpanel.php?logout=true';
            }
        }

        // Fungsi untuk membuka modal
        function openModal() {
            document.getElementById('editModal').style.display = 'flex';
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        // Fungsi untuk menyimpan perubahan (menutup modal setelahnya)
        function saveChanges() {
            // Menyimpan data di sini
            closeModal(); // Tutup modal setelah perubahan disimpan
        }

        // Pastikan modal tersembunyi saat halaman dimuat ulang
        window.onload = function () {
            document.getElementById('editModal').style.display = 'none';
        };

    </script>
</head>

<body>

    <div class="sidebar">
        <h2>Panel Admin</h2>
        <a href="adminpanel.php"><i class="fa fa-dashboard"></i> Beranda</a>
        <a href="manageuser.php"><i class="fa fa-users"></i> User</a>
        <a href="managefotografer.php"><i class="fa fa-camera"></i> Fotografer</a>
        <a href="pendapatan.php"><i class="fa fa-money"></i> Pendapatan</a>
        <a href="javascript:void(0);" onclick="logout()"><i class="fa fa-sign-out"></i> Logout</a>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>User</h1>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>Profil</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Bio</th>
                <th>Role</th>
            </tr>

            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><img src="uploads/<?= !empty($user['profiluser']) ? $user['profiluser'] : 'defaultprofil.jpg' ?>"
                            alt="Profil" width="40" height="40" style="border-radius: 50%;"></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['phone'] ?></td>
                    <td><?= $user['bio'] ?></td>
                    <td class="action-buttons">
                        <button class="edit-btn"
                            onclick="openModal(<?= htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8') ?>)">Edit</button>

                        <!-- Tombol Delete menggunakan button -->
                        <button class="delete-btn" onclick="deleteUser(<?= $user['id'] ?>)">Hapus</button>
                    </td>


                </tr>
            <?php endforeach; ?>
        </table>

        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" class="<?= $page == $i ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>
    </div>

    <!-- Modal HTML -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">Edit Pengguna</div>
                <div class="modal-body">
                    <form id="editForm" method="post" action="updateuser.php">
                        <input type="hidden" name="id" id="userId">

                        <label for="userName">Nama</label>
                        <input type="text" name="name" id="userName" required>

                        <label for="userEmail">Email</label>
                        <input type="email" name="email" id="userEmail" required>

                        <label for="userPhone">Nomor Telepon</label>
                        <input type="tel" name="phone" id="userPhone">

                        <label for="userBio">Bio</label>
                        <input type="bio" name="bio" id="userBio">

                        <label for="userRole">Role</label>
                        <select name="role" id="userRole" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="user">User</option>
                            <option value="fotografer">Fotografer</option>
                            <option value="admin">Admin</option>
                        </select>

                        <div class="modal-footer">
                            <button type="submit" class="save-btn">Simpan</button>
                            <button type="button" class="cancel-btn" onclick="closeModal()">Batal</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <script>
            function openEditModal() {
                // Menampilkan modal untuk mengedit profil
                $('#editProfileModal').modal('show');
            }
            const modal = document.getElementById('editModal');

            function openModal(user) {
                document.getElementById('userId').value = user.id;
                document.getElementById('userName').value = user.name;
                document.getElementById('userEmail').value = user.email;
                document.getElementById('userPhone').value = user.phone;
                document.getElementById('userBio').value = user.bio;
                document.getElementById('userRole').value = user.role;
                modal.style.display = 'flex';
            }

            function closeModal() {
                modal.style.display = 'none';
            }

            window.onclick = function (event) {
                if (event.target == modal) {
                    closeModal();
                }
            }
            function deleteUser(userId) {
                // Tampilkan konfirmasi sebelum menghapus
                if (confirm('Apakah Anda yakin ingin menghapus akun ini?')) {
                    // Jika konfirmasi benar, arahkan ke halaman deleteuser.php dengan ID pengguna
                    window.location.href = 'deleteuser.php?id=' + userId;
                }
            }

        </script>

</body>

</html>