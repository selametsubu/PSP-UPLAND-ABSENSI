CREATE OR REPLACE VIEW v_absen_hadir AS  
SELECT 
	u.fullname,
	h.*,
	CONVERT(CONCAT(DATE_FORMAT(h.tgl, '%d-%m-%Y'), ' ', h.waktu, ' ' ,h.waktu_bagian)  USING utf8) AS waktu_text,
	CONCAT(h.lat, ', ', h.lng) AS koordinat_text,
	CONCAT(h.desa, ', ', h.kec, ', ', h.kab, ', ', h.prov) AS region_text
FROM absen_hadir h
LEFT JOIN sys_user u ON u.userid = h.userid
;