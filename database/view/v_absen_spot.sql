CREATE OR REPLACE VIEW v_absen_spot AS 
SELECT 
	a.*,
	IFNULL(s.total,0) AS total_personil 
FROM  absen_spot a
LEFT JOIN (
	SELECT 
		s.spotid,
		COUNT(*) AS total
	FROM sys_user s
	WHERE s.spotid IS NOT null
	GROUP BY s.spotid
) s ON s.spotid = a.spotid