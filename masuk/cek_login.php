<?php
    include "../configurasi/koneksi.php";
    include "../configurasi/fungsi_logs.php";

    $username = $_POST['username'];
    $password = $_POST['password'];
    
        // Ambil data user dari database
        $sql = "SELECT * FROM admin WHERE username = ? LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->execute([$username]);
    
        if ($stmt->rowCount() === 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashedPassword = $row['password'];
            
            // Verifikasi password
            if (password_verify($password, $hashedPassword)) {
                // Cek apakah akun diblokir
                if ($row['blokir'] == 'N') {
                    // Login berhasil
                    session_start();
                    include "timeout.php";
                
                    $_SESSION['id_admin']    = $row['id_admin'];
                    $_SESSION['idadmin']    = $row['id_admin'];
                    $_SESSION['username']    = $row['username'];
                    $_SESSION['namauser']    = $row['username'];
                    $_SESSION['namalengkap'] = $row['nama_lengkap'];
                    $_SESSION['passuser']    = $row['password'];
                    $_SESSION['leveluser']   = "admin";
                    $_SESSION['mpengguna']   = $row['mpengguna'];
                    $_SESSION['mheader']   = $row['mheader'];
                    $_SESSION['mjenisbayar']     = $row['mjenisbayar'];
                    $_SESSION['mpelanggan']     = $row['mpelanggan'];
                    $_SESSION['msupplier']     = $row['msupplier'];
                    $_SESSION['msatuan']   = $row['msatuan'];
                    $_SESSION['mjenisobat']   = $row['mjenisobat'];
                    $_SESSION['mbarang']      = $row['mbarang'];
                    $_SESSION['tbm']    = $row['tbm'];
                    $_SESSION['tbmpbf']    = $row['tbmpbf'];
                    $_SESSION['tpk']    = $row['tpk'];
                    $_SESSION['lpitem'] = $row['lpitem'];
                    $_SESSION['lpbrgmasuk'] = $row['lpbrgmasuk'];
                    $_SESSION['lpkasir'] = $row['lpkasir'];
                    $_SESSION['lpsupplier'] = $row['lpsupplier'];
                    $_SESSION['lppelanggan'] = $row['lppelanggan'];
                    $_SESSION['mstok'] = $row['mstok'];
                    $_SESSION['stok_kritis'] = $row['stok_kritis'];
                    $_SESSION['orders'] = $row['orders'];
                    $_SESSION['penjualansebelum'] = $row['penjualansebelum'];
                    $_SESSION['labapenjualan'] = $row['labapenjualan'];
                    $_SESSION['byrkredit'] = $row['byrkredit'];
                    $_SESSION['stokopname'] = $row['stokopname'];
                    $_SESSION['soharian'] = $row['soharian'];
                    $_SESSION['labajenisobat'] = $row['labajenisobat'];
                    $_SESSION['koreksistok'] = $row['koreksistok'];
                    $_SESSION['shiftkerja'] = $row['shiftkerja'];
                    $_SESSION['neraca'] = $row['neraca'];
                    $_SESSION['level'] = $row['akses_level'];
                    $_SESSION['komisi'] = $row['komisi'];
                    $_SESSION['kartustok'] = $row['kartustok'];
                    $_SESSION['catatan'] = $row['catatan'];
                    $_SESSION['cekdarah'] = $row['cekdarah'];
                    $_SESSION['jurnalkas'] = $row['jurnalkas'];
                
                    // session timeout
                    $_SESSION['login'] = 1;
                    timer();
                
                    $sid_lama = session_id();
                
                    session_regenerate_id();
                
                    $sid_baru = session_id();
                  
                
                    insertlogs($row['id_admin'], $row['nama_lengkap'], "Masuk Login");
                    
                    // Catat login time
                    $login_time = date("Y-m-d H:i:s");
                    $ip_address = $_SERVER['REMOTE_ADDR'];
                    $session_id = session_id();
                    $stmt_log = $db->prepare("INSERT INTO user_login_logs (user_id, username, login_time, ip_address, session_id) VALUES (?, ?, ?, ?, ?)");
                    $stmt_log->execute([$row['id_admin'], $row['username'], $login_time, $ip_address, $session_id]);
                    
                    header('location:media_admin.php?module=home');
                } else {
                    echo "<link href=css/style.css rel=stylesheet type=text/css>";
                    echo "<div class='error msg'>Akun Anda diblokir. Hubungi administrator.</div>";
                }
            } else {
                echo "<link href=css/style.css rel=stylesheet type=text/css>";
                echo "<div class='error msg'>Password salah.</div>";
            }
        } else {
            echo "<script type='text/javascript'>window.alert('Username dan Password tidak ditemukan');
                    window.location='media_admin.php?module=home'</script>";
            // echo "<link href=css/style.css rel=stylesheet type=text/css>";
            // echo "<div class='error msg'>Username tidak ditemukan.</div>";
        }

