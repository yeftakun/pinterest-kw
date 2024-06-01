# Pinterest KW

## CREDIT

[Icon](https://id.pinterest.com/pin/408912841182046181/)

**Catatan:**

- di file `daftar.php` input file gambar memang sengaja di *comment*. Jadikan saja file ini referensi untuk **update profile**
- di `storage/profile` itu ada `default.png` jangan dihapus ^^

### Database:

#### 1. Event Hapus data yang belum di validasi saat 30 menit

Input gambar tidak dipakai karena ketika akun yang belum tervalidasi dihapus file gambar tertinggal di direktori `storage/profile/`.

```
DELIMITER $$

CREATE EVENT hapus_data_nonaktif
ON SCHEDULE EVERY 1 MINUTE
DO
BEGIN
    DELETE FROM users WHERE status = 'Nonaktif' AND delete_in <= NOW();
END$$

DELIMITER ;
```

```
SET GLOBAL event_scheduler = ON;
```
