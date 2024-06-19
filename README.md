
# Bolt PHP Framework

**Bolt** is a lightweight and highly extendable PHP micro-framework designed for building modern web applications with ease. Bolt aims to provide a simple yet powerful structure for managing controllers, models, views, and routing.

## Features

- Lightweight and easy to use
- MVC architecture
- Simple and flexible routing system
- Composer autoloading
- Environment configuration using `.env`
- Extendable and customizable

## Installation

To get started with Bolt, you need to have PHP and Composer installed on your system. Follow the steps below to set up a new Bolt project.

### 1. Clone the Repository

Clone the Bolt repository from GitHub:

```sh
git clone https://github.com/bayrameker/bolt.git
cd bolt
```

### 2. Install Dependencies

Install the required Composer dependencies:

```sh
composer install
```

### 3. Set Up Environment Variables

Copy the `.env.example` file to `.env` and configure your environment variables:

```sh
cp .env.example .env
```

Edit the `.env` file to match your configuration:

```env
APP_NAME="Bolt Framework"
APP_ENV=local
APP_DEBUG=true
APP_PORT=8080

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Start the Development Server

Start the development server using the Bolt CLI tool:

```sh
php bolt serve
```

By default, the server will run on port 8080. You can access your application at `http://localhost:8080`.

## Project Structure

Here's an overview of the project's directory structure:

```
bolt/
├── app/
│   ├── Controllers/
│   │   └── HomeController.php
│   ├── Models/
│   │   └── Project.php
│   ├── Repositories/
│   │   └── ProjectRepository.php
│   ├── Services/
│   │   ├── AIService.php
│   │   └── ProjectService.php
│   ├── Views/
│       ├── layout.php
│       ├── home.php
├── config/
│   ├── app.php
│   └── database.php
├── core/
│   ├── Application.php
│   ├── Controller.php
│   ├── Database.php
│   ├── Model.php
│   ├── Repository.php
│   ├── Service.php
│   ├── Request.php
│   ├── Response.php
│   ├── Router.php
│   ├── View.php
│   └── AI.php
├── public/
│   ├── index.php
│   └── favicon.ico
├── storage/
│   ├── logs/
│   ├── migrations/
│   │   └── 2024_06_19_000001_create_projects_table.php
│   └── seeds/
│       └── ProjectSeeder.php
├── vendor/
├── .htaccess
├── composer.json
├── .env
└── bolt
```

## Usage

### Controllers

Controllers handle the request logic and return responses. To create a new controller, use the Bolt CLI tool:

```sh
php bolt controller Example
```

This will create a new `ExampleController.php` file in the `app/Controllers` directory.

#### Example Controller

```php
<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Response;

class ExampleController extends Controller
{
    public function registerRoutes($router)
    {
        $router->get('/example', [$this, 'index']);
    }

    public function index(Request $request, Response $response)
    {
        $this->render('example', ['message' => 'Hello from ExampleController!']);
    }
}
```

### Models

Models represent the data structure and handle database interactions. To create a new model, use the Bolt CLI tool:

```sh
php bolt model Example
```

This will create a new `Example.php` file in the `app/Models` directory.

#### Example Model

```php
<?php

namespace App\Models;

use Core\Model;

class Example extends Model
{
    protected $fillable = ['name', 'description'];
}
```

### Views

Views handle the presentation layer. Create a new view file in the `app/Views` directory.

#### Example View (`app/Views/example.php`)

```php
<p><?= $message ?></p>
```

### Routing

Routes are defined in the controller classes. Bolt supports GET and POST requests.

#### Defining Routes

```php
$router->get('/example', [$this, 'index']);
$router->post('/example', [$this, 'store']);
```

### Environment Configuration

Bolt uses the `.env` file for environment configuration. This file contains key-value pairs for various configuration options.

#### Example `.env` File

```env
APP_NAME="Bolt Framework"
APP_ENV=local
APP_DEBUG=true
APP_PORT=8080

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## Extending Bolt

Bolt is designed to be easily extendable. You can add custom services, repositories, and more by following the structure provided.

### Creating a Service

To create a new service, use the Bolt CLI tool:

```sh
php bolt service Example
```

This will create a new `ExampleService.php` file in the `app/Services` directory.

#### Example Service

```php
<?php

namespace App\Services;

use Core\Service;

class ExampleService extends Service
{
    // Service methods
}
```

### Creating a Repository

To create a new repository, use the Bolt CLI tool:

```sh
php bolt repository Example
```

This will create a new `ExampleRepository.php` file in the `app/Repositories` directory.

#### Example Repository

```php
<?php

namespace App\Repositories;

use Core\Repository;
use App\Models\Example;

class ExampleRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new Example());
    }
}
```

## Conclusion

Bolt is a lightweight and highly extendable PHP micro-framework that provides a solid foundation for building modern web applications. Its simple and flexible structure allows you to quickly develop and deploy your projects. Feel free to explore and customize Bolt to fit your needs.

For more information and the latest updates, visit the [Bolt GitHub repository](https://github.com/bayrameker/bolt).



