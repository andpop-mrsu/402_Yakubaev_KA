@echo off

chcp 65001>nul

php cold-hot.php %1 %2

pause