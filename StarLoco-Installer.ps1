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
scoop bucket add versions
Write-Host "Install scoop apps"
scoop install oraclejre8 mariadb apache php dbeaver
iex (new-object net.webclient).downloadstring('https://gist.githubusercontent.com/lukesampson/6546858/raw/015e8bdfbfda8e571f556863f44e7b3df29f773b/apache-php-init.ps1')

Copy-Item -Path ./config/httpd.conf -Destination ~/scoop/apps/apache/current/conf/httpd.conf -Force
Copy-Item -Path ./config/php.ini -Destination ~/scoop/apps/php/current/php.ini -Force


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
Write-Host "Install Apache2 service"
httpd -k install -n apache
Write-Host "Start Apache2 service"
Start-Service -Name "Apache2.4"

# Copy lang files from web repository to apache public folder
Write-Host "Copy web folder content into Apache2 htdocs"
Copy-Item -Path $Desktop/StarLoco/web/* -Destination ~/scoop/apps/apache/current/htdocs/ -Recurse -Force
Remove-Item  ~/scoop/apps/apache/current/htdocs/index.html

# Create and start MySQL service (will run automatically after a reboot)
Write-Host "Install MariaDB service"
mysqld --install
Write-Host "Start MariaDB service"
Start-Service -Name "MySQL"

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
