# StarLoco Guide

## Summary
- [Introduction](#introduction)
- [Configuration](#configuration)
- [Startup](#startup)
- [Community](#community)

## Introduction

During this guide, we'll install multiple softwares necessary for the proper functioning of the emulator. 
These installations will be done by command line entry under PowerShell.

List of the softwares :
- [Scoop](https://scoop.sh/), a command-line installer for Windows.
- [Git](https://git-scm.com/)
- [Java 8 (JRE)](https://www.java.com/fr/download/manual.jsp)
- [MySQL Server 8](https://dev.mysql.com/downloads/mysql/)
- [DBeaver](https://dbeaver.io/)
- [Apache Server](https://httpd.apache.org/download.cgi)

### Scoop install
Open a PowerShell terminal (included in Windows) using the Windows search, and enter :
```powershell
Set-ExecutionPolicy RemoteSigned -Scope CurrentUser
irm get.scoop.sh | iex
```
That's done, now if you write "scoop" in your terminal, it should list all the scoop commands !

You can now install all the prerequisites by entering in your terminal theses commands, one by one :
```
scoop bucket add main
scoop bucket add java
scoop bucket add extras
scoop install git oraclejre8 mysql apache dbeaver
```

The applications are installed in your user directory : C:\Users\<your_username>\scoop\apps

## Configuration

Open a PowerShell terminal (included in Windows) using the Windows search, and enter, one by one :
```
cd ~/Desktop
mkdir StarLoco
cd StarLoco
```


You can now clone the following repositories :
- Dofus client :
`git clone https://github.com/StarLoco/StarLoco-Client.git client`
- StarLoco Login :
`git clone https://github.com/StarLoco/StarLoco-Login.git login`
- StarLoco Game :
`git clone https://github.com/StarLoco/StarLoco-Game.git game`
- Web :
`git clone https://github.com/StarLoco/StarLoco-Web.git web`

Now, on your desktop, inside a folder named `StarLoco`, you must found 4 directories : `client`, `web`, `login` and `game`.

### Apache configuration

You can copy all the content from `web` folder inside `C:\Users\<your_username>\scoop\apps\apache\current\htdocs`

### MySQL configuration

Run "DBeaver" through the Windows search. Login into your MySQL server using the user `root` with no password on host `127.0.0.1`.

You can create 2 databases, named :
- `starloco_login`
- `starloco_game`

Then execute a SQL file inside both of them :
- `login.sql` which is located in `login/bin` in `starloco_login` database
- `game.sql` which is located in `game/bin` in `starloco_game` database

## Startup

### Login startup

You just need to run `start.bat` file inside `login/bin`

At the end, it must output :
```
...
[main] INFO  org.starloco.locos.kernel.Console -  > Exchange server started on port 666
[main] INFO  org.starloco.locos.kernel.Console -  > Login server started on port 450
[main] INFO  org.starloco.locos.kernel.Console -  > Console >
```

### Game startup
You just need to run `start.bat` file inside `game/bin`

At the end, it must output :
```
...
[main] INFO  org.starloco.locos.kernel.Main - The game server started on address : 5555
[main] INFO  o.s.locos.exchange.ExchangeClient - The exchange client was connected on address : 127.0.0.1:666
[main] INFO  org.starloco.locos.kernel.Main - The server is ready ! Waiting for connection..
```

### Client startup

Execute `Dofus.exe` inside the client folder and try to log-in with the user `test` with password `test`.

You should successfully get into the game !

## Community

If you've any error or difficulty to run something, please ask the community on this discord server.

![Discord Banner 2](https://discordapp.com/api/guilds/856945561421086730/widget.png?style=banner2)




