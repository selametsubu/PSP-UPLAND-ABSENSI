CREATE OR REPLACE VIEW v_absen_izin AS 
SELECT 
	i.*,
	CONCAT(DATE_FORMAT(i.tgl_dari,'%d-%m-%Y'), ' s/d ', DATE_FORMAT(i.tgl_sampai,'%d-%m-%Y')) AS tanggal_text,
	DATEDIFF(i.tgl_sampai, i.tgl_dari) + 1 AS durasi,
	u.fullname,
	u.nik 
FROM absen_izin i
LEFT JOIN sys_user u ON u.userid = i.userid