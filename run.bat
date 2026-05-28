@echo off
echo Starting Laravel and Vite servers...
cd backend
start cmd /k "php artisan serve"
start cmd /k "npm run dev"
echo Servers are starting in separate windows.
pause
