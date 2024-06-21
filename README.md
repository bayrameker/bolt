
# Bolt Framework

Bolt is a lightweight and extendable PHP micro framework designed to simplify modern PHP application development with built-in support for AI integration.

## Features

- MVC architecture
- Simple and flexible routing system
- Database ORM and migration support
- Environment variable management with `.env` file
- Command-line interface (CLI) for easy usage
- Ready for AI integration

## Installation

### Requirements

- PHP 7.4 or higher
- Composer

### Step 1: Clone the Project

```bash
git clone https://github.com/yourusername/bolt.git
cd bolt
```

### Step 2: Install Dependencies

```bash
composer install
```

### Step 3: Configure the .env File

Create a `.env` file in the project root directory and configure it as follows:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_NAME=your_database_name
DB_USER=your_database_username
DB_PASS=your_database_password
APP_PORT=8080
```

### Step 4: Start the Server

```bash
php bolt serve
```

Open your browser and navigate to `http://localhost:8080` to see your application running.

## Usage

### Command-Line Interface (CLI)

Bolt provides a CLI tool to perform various tasks easily.

#### Create a Controller

```bash
php bolt controller Home
```

#### Create a Model

```bash
php bolt model User
```

#### Create a Service

```bash
php bolt service UserService
```

#### Create a Repository

```bash
php bolt repository UserRepository
```

#### Create a Migration

```bash
php bolt migration create_users_table
```

#### Run Migrations

```bash
php bolt migrate
```

#### Run Seeds

```bash
php bolt seed
```

### MVC Structure

#### Controller

Controllers are located in the `app/Controllers` directory. When you create a new controller, it looks like this:

```php
<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Response;
use Core\ViewRenderer;

class HomeController extends Controller
{
    public function registerRoutes($router)
    {
        $router->get('/', [$this, 'index']);
    }

    public function index(Request $request, Response $response)
    {
        $viewRenderer = new ViewRenderer('home', [
            'title' => 'Home Page',
            'message' => 'Welcome to My Bolt Framework!',
            'layout' => 'layout'
        ]);
        $viewRenderer->render();
    }
}
```

#### Model

Models are located in the `app/Models` directory. When you create a new model, it looks like this:

```php
<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    protected $fillable = ['name', 'email', 'password'];
    protected $table = 'users';
}
```

#### Service

Services are located in the `app/Services` directory. When you create a new service, it looks like this:

```php
<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllUsers()
    {
        return $this->repository->findAll();
    }

    public function getUserById($id)
    {
        return $this->repository->find($id);
    }

    public function createUser($data)
    {
        return $this->repository->create($data);
    }

    public function updateUser($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->repository->delete($id);
    }
}
```

#### Repository

Repositories are located in the `app/Repositories` directory. When you create a new repository, it looks like this:

```php
<?php

namespace App\Repositories;

use Core\Repository;
use App\Models\User;

class UserRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new User());
    }
}
```

#### Migration

Migration files are located in the `database/migrations` directory. When you create a new migration, it looks like this:

```php
<?php

use Core\Migration;

class CreateUsersTable
{
    public function up()
    {
        $migration = new Migration();
        $migration->createTable('users', function ($table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->timestamps();
        });
    }
}
```

## Structure

- `app/Controllers`: Controller files
- `app/Models`: Model files
- `app/Services`: Service files
- `app/Repositories`: Repository files
- `app/Views`: View files
- `core`: Framework core files
- `database/migrations`: Migration files
- `database/seeds`: Seed files
- `public`: Publicly accessible files (CSS, JS, images, etc.)
- `.env`: Environment variables

## Contributing

If you want to contribute to Bolt, please submit a pull request. We welcome contributions!

## License

This project is licensed under the MIT License. See the `LICENSE` file for more details.
```

This README provides a comprehensive overview of the Bolt framework, including installation, usage, and a description of its structure and features.