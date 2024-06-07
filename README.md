# Pinterest KW

### Whats New?

Perubahan terbaru pada proyek:

- Tinggal implementasi frontend

### CREDIT

[Icon](https://id.pinterest.com/pin/408912841182046181/)

### Catatan:
- Jangan menaruh file penting di `storage/posting/` karena file di direktori ini akan terhapus jika namanya tidak terdapat di kolom `posts.post_img_path`.

### Database:

#### 1. Event Hapus data yang belum di validasi saat 3 menit

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
