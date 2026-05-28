# Start Laravel Server
Write-Host "Starting Laravel Server..." -ForegroundColor Green
Start-Process powershell -ArgumentList "-NoExit", "-Command", "cd backend; php artisan serve"

# Start Vite Dev Server
Write-Host "Starting Vite Dev Server..." -ForegroundColor Cyan
Start-Process powershell -ArgumentList "-NoExit", "-Command", "cd backend; npm run dev"

Write-Host "Both servers are starting in new windows." -ForegroundColor Yellow
