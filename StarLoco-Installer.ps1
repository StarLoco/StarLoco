# Scoop installation
Set-ExecutionPolicy RemoteSigned -Scope CurrentUser
irm get.scoop.sh | iex

# Dependencies installation (git, java, mysql, apache, dbeaver)
scoop bucket add main
scoop bucket add java
scoop bucket add extras
scoop install git oraclejre8 mysql apache dbeaver

# Locate global folder
cd ~/Desktop
mkdir StarLoco
cd StarLoco

# Clone all repositories into global folder
git clone https://github.com/StarLoco/StarLoco-Client.git client
git clone https://github.com/StarLoco/StarLoco-Login.git login
git clone https://github.com/StarLoco/StarLoco-Game.git game
git clone https://github.com/StarLoco/StarLoco-Web.git web

# Create and start Apache service (will run automatically after a reboot)
sudo httpd.exe -k install
sudo Start-Service -Name "Apache2.4"

# Copy lang files from web repository to apache public folder
cp ~/Desktop/StarLoco/web/ ~/scoop/apps/apache/current/

# Create and start MySQL service (will run automatically after a reboot)
sudo mysqld --install
sudo Start-Service -Name "MySQL"

# Create both database login & game
mysql -u root -e 'CREATE DATABASE starloco_login; CREATE DATABASE starloco_game;'
# Run login SQL script into login database
mysql -u root < ~/Desktop/StarLoco/login/bin/login.sql
# Run game SQL script into game database
mysql -u root < ~/Desktop/StarLoco/game/bin/game.sql