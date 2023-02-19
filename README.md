# StarLoco Guide

## Summary
- Prerequisite


## Prerequisite

In order to run StarLoco successfully, you'll need to install these softwares :
- Java 8 (JRE)
- MySQL Server 8
- Apache Server

To do this, I recommend you to use [Scoop](https://scoop.sh/), a command-line installer for Windows.

### Scoop install
Open a PowerShell terminal, and enter :
```powershell
Set-ExecutionPolicy RemoteSigned -Scope CurrentUser
irm get.scoop.sh | iex
```
That's done, now if you write "scoop" in your terminal, it should list all the scoop commands !

### Java 8 install
In a PowerShell terminal, enter :
```
scoop bucket add java
scoop install oraclejre8
```
That's done, check if java is available by entering "java --version"

### MySQL Server v8
In a PowerShell terminal, enter :
```
scoop bucket add main
scoop install mysql
```
That's done, check if MySQL is available by entering "mysql version"

### Apache Server


