<?php
// Simple fix - run this file directly from terminal
$dbPath = 'C:/Users/Thinkpad/Desktop/restorant/restaurant/database/database.sqlite';

try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Rename old table
    $pdo->exec("ALTER TABLE settings RENAME TO settings_old");

    // Create new table with TEXT locale
    $pdo->exec("
        CREATE TABLE settings (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(255),
            logo VARCHAR(255),
            description TEXT,
            phone VARCHAR(255),
            whatsapp VARCHAR(255),
            address TEXT,
            lat REAL,
            lng REAL,
            is_active INTEGER DEFAULT 1,
            prep_time INTEGER DEFAULT 30,
            min_order REAL DEFAULT 10,
            delivery_radius INTEGER DEFAULT 5,
            opening_hours TEXT,
            locale TEXT DEFAULT 'fr'
        )
    ");

    // Copy data with default locale
    $pdo->exec("
        INSERT INTO settings (id, name, logo, description, phone, whatsapp, address, lat, lng, is_active, prep_time, min_order, delivery_radius, opening_hours, locale)
        SELECT id, name, logo, description, phone, whatsapp, address, lat, lng, is_active, prep_time, min_order, delivery_radius, opening_hours, 'fr'
        FROM settings_old
    ");

    // Drop old table
    $pdo->exec("DROP TABLE settings_old");

    echo "SUCCESS: Database updated!\n";

} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

