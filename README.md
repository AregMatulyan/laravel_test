# Laravel Test App

## Installation
In order to install the app in a simple way, I developed a single command which will do all steps.

Navigate via terminal to the app root folder and execute this command.

> Important!
>
> The Laravel Test App has been developed using [Docker](https://docs.docker.com/get-docker/).
> 
>
> Before proceeding make sure you have installed
> * [Docker](https://docs.docker.com/get-docker/)
> * [Composer](https://getcomposer.org/download/)
> * PIXABAY_API_KEY is defined in the .env.example file
> 

```
./scripts/install.sh
```

> Note:
>
> This command will also start the project.
> 
> After execution open a browser [http://localhost/](http://localhost/)

- - - 

## Start the app
Navigate via terminal to the app root folder and execute this command.

```
./scripts/up.sh
```

## Stop the app
Navigate via terminal to the app root folder and execute this command.

```
./scripts/stop.sh
```

> This also will remove docker containers.

## Remove cache
Navigate via terminal to the app root folder and execute this command.

```
./scripts/ant.sh
```
