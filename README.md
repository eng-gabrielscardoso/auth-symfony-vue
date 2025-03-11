<div align="center">

# Auth + Symfony + Vue

![Main technologies](https://go-skill-icons.vercel.app/api/icons?i=ts,vuejs,tailwindcss,daisyui,nodejs,php,symfony,mysql,docker,vscode,github,linux)

This project is a simple authentication system made mainly using Symfony and Vue.js.

</div>

## Installation

> For this project, you must have Composer, NPM/Node.js and also Docker+Docker Compose (or MySQL Server) installed on your computer. Also make sure to have the [Symfony CLI](https://symfony.com/download) installed.

This project was structured to operate in decoupled services, allowing decentralized maintenance and also facilitating the scope of the project. The technologies used were Symfony and Vue.js, so keep in mind that to use the project you need to have at least some knowledge of PHP, JavaScript/TypeScript, and also of subjects such as databases and Docker.

### The REST API

The REST API is the core of the system, and to use it, navigate to its directory and start performing some routines to install the necessary dependencies.

First, run `composer install` to install the Symfony dependencies. This may take a while depending on your internet connection.

Then, run `docker compose up -d` (if you are using Docker) to start the MySQL database container. If you prefer not to use Docker, you can also do the local installation by simply replacing the environment variables related to the connection URL in the `.env` file in the project root (suggestion: do it in `.env.local` so as not to expose your credentials).

After that, you can run the command `php bin/console doctrine:migrations:migrate` to set up the database (since we are using migrations).

Finally, the project can be run using the command `symfony server:start` to start the server.

### The Web Application

The web client runs on Vue.js, so installation is also quite simple. First, run the command `cp .env.example .env` to have your environment variables ready for execution.

After that, just run the command `npm install` to install the dependencies needed for the application. At the end, you can run `npm run dev` to upload the application (API integration is automatic, so don't worry).

## Author

This project is authored by [Gabriel Santos Cardoso](https://gabrielscardoso.com).

## Licence

This project is licenced under the [MIT Licence](LICENSE).
