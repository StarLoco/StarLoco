# Install StarLoco using Docker

First of all, you must have installed Docker and docker-compose on your computer, you can follow the  [official docker instructions here](https://docs.docker.com/compose/install/).

Ensure you've fully installed docker by running theses commands in a terminal :
```bash
> docker --version
Docker version 20.10.24, build 297e128 
> docker-compose --version
Docker Compose version v2.17.2
```

Now, if you're ready, clone or download the repository and run a terminal inside the "docker" folder.

To startup the server and all his dependencies, run :
```
docker-compose up -d
```

If you want to stop it :
```
docker-compose down
```

It will automatically run for you :
- Login server
- Game server
- MariaDB server, including two databases (login & game) with the latest data
- Web server, including a website and official langs for running the client
- Adminer, to manipulate your databases through the web

If you've any problem using Docker, I recommend you to search on the officiel documentations, google, stackoverflow or github.
