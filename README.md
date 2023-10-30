# <p align="center">CBT Exam</p>

## About CBT Exam

<p align="center"> **CBT Exam** is an innovative examination platform that leverages machine learning to deliver a customized and effective assessment experience. It incorporates both objective and subjective examination modes to cater to diverse student needs. This project originated as a final year endeavor and is offered free of charge for educational institutions and individuals seeking an advanced examination solution.This project is a practice laravel project designed as a practice project to learn the basice operations on a site which are Create, Read, Update and Delete shortened to CRUD
</p>

## Getting Started

-   [Installation]
-   [Requirement]
-   [Setting Up]

## Installation

1. Clone the repository:
   You can get the app by cloning it to your local repo using the git clone command
   See the Github documentation to learn more about cloning repos or enter

    ```bash
    git clone https://github.com/Dhalintin/cbtexam.git
    ```

2. Run migrations:

    ```bash
    php artisan migrate
    ```

    Note: As of the documentation's last update, there were no factory data provided with the project. Therefore, users are required to input the necessary data for testing.

## Requirement

-   **Laravel**: Version 9.0 or higher
-   **Livewire**: Version 2.0 or higher
-   **Tailwind CSS**: Version 3.0 or higher
-   **AlpineJS**: Version 3.0 or higher
-   **Composer**
-   **Node.js**

#### Server:

-   **CPU**: Quad-core processor or higher
-   **RAM**: 8 GB or more
-   **Storage**: 100 GB or more

#### Database:

-   **MySQL**: Version 8.0 or higher
-   **PostgreSQL**: Version 14 or higher

#### Web Server:

-   **Nginx**: Version 1.20 or higher
-   **Apache**: Version 2.4 or higher
-   **PHP**: Version 8.0 or higher

### Setting Up

After Cloning this repo enter into the folder

```shell
cd crud-product
```

Run the folloWing command to install all neccesary dependencies

```shell
composer install
```

```shell
npm install
```

And fund them

```shell
    npm fund
```

Create a .env file

```shell
    touch .env
```

Copy the content .env.example in the .env

```shell
    cp .env.example .env
```

Configure the <code>.env</code> file

Run the migration and seed the database in one step

```shell
    php artisan migrate:fresh --seed</code>
```

## Start your server

```shell
    php artisan serve
```

## License

Unlicensed

# CBT EXAM

## Requirements

## Feedback

We welcome your recommendations and feedback on **CBT Exam**. Please feel free to reach out with any suggestions or comments to help us enhance this educational software. Your input is invaluable in our ongoing efforts to improve the system.
