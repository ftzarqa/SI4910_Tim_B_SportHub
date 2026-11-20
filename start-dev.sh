#!/usr/bin/env bash
set -e

echo "=== Mempersiapkan Environment Dev SportHub ==="

echo "[1/5] Menghentikan proses 'php artisan serve' yang nyangkut..."
pkill -f "artisan serve" 2>/dev/null || true

echo "[2/5] Memeriksa status Docker daemon..."
if ! docker info >/dev/null 2>&1; then
    echo "ERROR: Docker belum berjalan. Jalankan: sudo systemctl start docker"
    exit 1
fi

echo "[3/5] Menjalankan Docker Sail..."
./vendor/bin/sail up -d

echo "[4/5] Menunggu MySQL siap & memastikan hak akses sporthub_db..."
until ./vendor/bin/sail exec -T mysql mysqladmin ping -h 127.0.0.1 --silent >/dev/null 2>&1; do
    sleep 1
done
./vendor/bin/sail exec -T mysql mysql -uroot -ppassword -e "CREATE DATABASE IF NOT EXISTS \`sporthub_db\`; GRANT ALL PRIVILEGES ON \`sporthub_db\`.* TO 'sail'@'%'; FLUSH PRIVILEGES;" >/dev/null 2>&1

echo "[5/5] Membersihkan cache aplikasi..."
./vendor/bin/sail artisan config:clear && ./vendor/bin/sail artisan route:clear && ./vendor/bin/sail artisan view:clear && (./vendor/bin/sail artisan cache:clear 2>/dev/null || true)

echo ""
echo "Server SportHub siap diakses di: http://localhost:8080/login"
