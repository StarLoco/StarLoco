$Desktop = [Environment]::GetFolderPath("Desktop")

# Scoop installation
if (Get-Command 'scoop' -errorAction SilentlyContinue) {
    Write-Host "Scoop's already installed"
} else {
    Set-ExecutionPolicy RemoteSigned -Scope CurrentUser
    irm get.scoop.sh | iex
}

# Dependencies installation (git, java, mysql, apache, dbeaver)
Write-Host "Add scoop buckets"
scoop install git
scoop bucket add main
scoop bucket add java
scoop bucket add extras
Write-Host "Install scoop apps"
scoop install sudo oraclejre8 mariadb apache dbeaver

# Locate global folder
cd $Desktop
If (-Not (Test-Path -Path "./StarLoco")) {
    Write-Host "Create StarLoco folder"
    mkdir StarLoco
}
Write-Host "Goto StarLoco folder"
cd StarLoco

# Clone all repositories into global folder
If (-Not (Test-Path -Path "./client")) {
    Write-Host "Cloning client folder..."
    git clone https://github.com/StarLoco/StarLoco-Client.git client
}
If (-Not (Test-Path -Path "./login")) {
    Write-Host "Cloning login folder..."
    git clone https://github.com/StarLoco/StarLoco-Login.git login
}
If (-Not (Test-Path -Path "./game")) {
    Write-Host "Cloning game folder..."
    git clone https://github.com/StarLoco/StarLoco-Game.git game
}
If (-Not (Test-Path -Path "./web")) {
    Write-Host "Cloning web folder..."
    git clone https://github.com/StarLoco/StarLoco-Web.git web
    Remove-Item ./web/.git -Force -Recurse
}

# Create and start Apache service (will run automatically after a reboot)
Write-Host "Install and start Apache2 service"
sudo httpd.exe -k install
sudo Start-Service -Name "Apache2.4"

# Copy lang files from web repository to apache public folder
Write-Host "Copy web folder content into Apache2 htdocs"
Copy-Item -Path $Desktop/StarLoco/web/* -Destination ~/scoop/apps/apache/current/htdocs/ -Recurse -Force

# Create and start MySQL service (will run automatically after a reboot)
Write-Host "Install and start MariaDB service"
sudo mysqld --install
sudo Start-Service -Name "MySQL"

# Create both database login & game
mysql -u root -e 'CREATE DATABASE starloco_login; CREATE DATABASE starloco_game;'
# Run login SQL script into login database
mysql -u root -D starloco_login -e "source $Desktop/StarLoco/login/bin/login.sql"
# Run game SQL script into game database
mysql -u root -D starloco_game -e "source $Desktop/StarLoco/game/bin/game.sql"

cd $Desktop/StarLoco/login/bin
Start start.bat
cd $Desktop/StarLoco/game/bin
Start start.bat

Start-Sleep -Seconds 3

cd $Desktop/StarLoco/client
Start Dofus.exe
