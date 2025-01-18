-- Berikut jawaban SQL Test
/* ------------------------------- -- Nomor 2 ------------------------------- */
SELECT 
    u.name AS Nama_Nasabah,
    a.account_type AS Jenis_Akun,
    a.balance AS Saldo,
    SUM(CASE WHEN t.type_transaction = 'Debit' THEN t.amount ELSE 0 END) AS Debit,
    SUM(CASE WHEN t.type_transaction = 'Kredit' THEN t.amount ELSE 0 END) AS Kredit
FROM 
    user u
JOIN 
    account a ON u.id = a.user_id
LEFT JOIN 
    transaction t ON a.id = t.account_id
GROUP BY 
    u.name, a.account_type, a.balance;

/* ------------------------------- -- Nomor 3 ------------------------------- */
SELECT 
    u.name AS Nasabah,
    'Giro' AS Jenis_Akun,
    CASE 
        WHEN a.account_type = 'Giro' THEN a.balance 
        ELSE NULL 
    END AS Saldo
FROM 
    user u
LEFT JOIN 
    account a ON u.id = a.user_id AND a.account_type = 'Giro'
ORDER BY 
    u.name;

/* ------------------------------- -- Nomor 4 ------------------------------- */
SELECT 
    u.name AS Nasabah,
    COALESCE(SUM(a.balance), 0) AS Jumlah_Asset,
    CONCAT(
        TIMESTAMPDIFF(YEAR, u.birthday, CURDATE()), ' Tahun ',
        MOD(TIMESTAMPDIFF(MONTH, u.birthday, CURDATE()), 12), ' Bulan ',
        DATEDIFF(CURDATE(), DATE_ADD(DATE_ADD(u.birthday, 
                 INTERVAL TIMESTAMPDIFF(YEAR, u.birthday, CURDATE()) YEAR), 
                 INTERVAL MOD(TIMESTAMPDIFF(MONTH, u.birthday, CURDATE()), 12) MONTH)), 
        ' Hari'
    ) AS Usia
FROM 
    user u
LEFT JOIN 
    account a ON u.id = a.user_id
GROUP BY 
    u.id
ORDER BY u.birthday DESC;

-- Nomor 5
SELECT 
    u.name AS Nama_Nasabah,
    SUM(a.balance) AS Jumlah_Saldo
FROM 
    user u
JOIN 
    account a ON u.id = a.user_id
WHERE 
    TIMESTAMPDIFF(YEAR, u.birthday, CURDATE()) < 40
GROUP BY 
    u.name
HAVING 
    SUM(a.balance) < 1000000
ORDER BY 
    u.name;

/* ------------------------------- -- Nomor 6 ------------------------------- */
UPDATE user
SET email = 'siti@example.com', 
    birthday = '1993-11-25'
WHERE name = 'Siti';

OR

UPDATE user
SET email = 'siti@example.com', 
    birthday = '1993-11-25'
WHERE id = 2;

/* ------------------------------- -- Nomor 7 ------------------------------- */
DELETE FROM transaction
WHERE id = 4;