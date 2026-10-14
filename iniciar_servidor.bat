@echo off
title Servidor CodeIgniter - Grupo Apple
echo ======================================================================
echo   SERVIDOR BACKEND CODEIGNITER 4 - GRUPO APPLE
echo   Escuchando en todas las interfaces de red (0.0.0.0:8080)
echo ======================================================================
echo   - Desde tu PC / Cable USB:   http://localhost:8080
echo   - Desde Hotspot de Laptop:   http://192.168.137.1:8080
echo   - Para detener el servidor:  Presiona CTRL + C
echo ======================================================================
echo.
cd /d "%~dp0"
echo [ADB] Habilitando comunicacion por cable USB para celular Android...
adb reverse tcp:8080 tcp:8080 >nul 2>nul
if %ERRORLEVEL% equ 0 (
    echo [ADB] Cable USB vinculado correctamente: el celular puede usar localhost:8080
) else (
    echo [ADB] No se detecto celular por USB o ADB no esta en el PATH.
)
echo.
C:\php\php.exe spark serve --host 0.0.0.0
pause
