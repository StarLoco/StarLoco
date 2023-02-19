# StarLoco Guide

## Summary
- Prerequisite
- Configuration
- Startup

## Prerequisite

In order to run StarLoco successfully, you'll need to install these softwares :
- Scoop
- Git
- Java 8 (JRE)
- MySQL Server 8
- DBeaver
- Apache Server

To do this, I recommend you to use [Scoop](https://scoop.sh/), a command-line installer for Windows.

### Scoop install
Open a PowerShell terminal, and enter :
```powershell
Set-ExecutionPolicy RemoteSigned -Scope CurrentUser
irm get.scoop.sh | iex
```
That's done, now if you write "scoop" in your terminal, it should list all the scoop commands !

You can now install all the prerequisites by entering in your terminal theses commands :
```
scoop bucket add main
scoop bucket add java
scoop bucket add extras
scoop install git
scoop install oraclejre8
scoop install mysql
scoop install apache
scoop install dbeaver
```

The applications are installed in your user directory : C:\Users\<your_username>\scoop\apps

## Configuration

Before doing anything, please clone the following repository on your desktop :
- Dofus client : git clone https://github.com/StarLoco/StarLoco-Client.git client
- StarLoco Login : git clone https://github.com/StarLoco/StarLoco-Login.git login
- StarLoco Game : git clone https://github.com/StarLoco/StarLoco-Game.git game
- Web : git clone https://github.com/StarLoco/StarLoco-Web.git web

Now, you must have 4 directories : client, web, login and game

### Apache configuration

You can copy all the content from "web" folder inside "C:\Users\<your_username>\scoop\apps\apache\htdocs"

### MySQL configuration

Run "DBeaver" through the Windows search. Login into your MySQL server using the user "root" with no password on host "127.0.0.1".

You can create 2 databases, named :
- starloco_login
- starloco_game

Then execute a SQL file inside both of them :
- login.sql which is located in login/bin in starloco_login database
- game.sql which is located in game/bin in starloco_game database

## Startup

### Login startup

You just need to run "start.bat" file inside "login/bin"

At the end, it must output :
```
...
[main] INFO  org.starloco.locos.kernel.Console -  > Exchange server started on port 666
[main] INFO  org.starloco.locos.kernel.Console -  > Login server started on port 450
[main] INFO  org.starloco.locos.kernel.Console -  > Console >
```

### Game startup
You just need to run "start.bat" file inside "game/bin"

At the end, it must output :
```
...
[main] INFO  org.starloco.locos.kernel.Main - The game server started on address : 5555
[main] INFO  o.s.locos.exchange.ExchangeClient - The exchange client was connected on address : 127.0.0.1:666
[main] INFO  org.starloco.locos.kernel.Main - The server is ready ! Waiting for connection..
```

### Client startup

Execute "Dofus.exe" inside "client" folder.





