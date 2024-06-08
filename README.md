
# Portofolio APP

Membuat CMS dengan laravel untuk portofolio


## Screenshots

![cover](https://github.com/EdwanNidzar/portofolio-app/assets/56621669/601bf99b-f69c-4b22-a5fe-b7d927dea34f)

## Prerequisites

Before you begin, ensure you have the following installed:

- [composer](https://getcomposer.org/download/)
- [PHP](https://www.php.net/downloads) (version 8.1 or higher)
- [Node.js](https://nodejs.org/en/download/package-manager)
## Installation

Clone the Repository

```bash
  git clone https://github.com/EdwanNidzar/portofolio-app.git
  cd portofolio-app
```


Install Dependencies

```bash
  composer install
```

Next, install JavaScript dependencies:

```bash
  npm install
```

Environment Configuration
Create a copy of the .env.example file and rename it to .env:

```bash
  cp .env.example .env
```

Generate the application key:

```bash
  php artisan key:generate
```

Set Up the Database

```bash
  php artisan migrate
```

Start the Laravel development server:

```bash
  npm run dev
```

```bash
  php artisan serve
```



## Authors

- [@EdwanNidzar](https://github.com/EdwanNidzar)


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

