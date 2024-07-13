
# Bolt PHP Framework

Bolt is a fast and lightweight PHP framework. Its simple and flexible structure makes it ideal for small to medium-sized projects.

## Features

- MVC (Model-View-Controller) architecture
- Simple routing system
- Easy and fast dependency injection
- View rendering support

## Installation

1. Clone or download this project:

```sh
git clone https://github.com/bayrameker/bolt
cd bolt
```

2. Install the necessary dependencies:

```sh
composer install
```

3. Create the `.env` file and configure the necessary settings:

```sh
cp .env.example .env
```

4. Start the server:

```sh
php bolt serve
```

## Usage

### Bolt Commands

The available commands for the Bolt framework are:

- `php bolt migrate` - Runs the database migrations.
- `php bolt create:migration {name}` - Creates a new database migration.
- `php bolt seed` - Runs the database seeders.
- `php bolt controller {name} [-v]` - Creates a new controller. Use the `-v` option to also add a view and route.
- `php bolt model {name}` - Creates a new model.
- `php bolt service {name}` - Creates a new service.
- `php bolt repository {name}` - Creates a new repository.
- `php bolt dump-autoload` - Updates Composer autoload files.
- `php bolt serve` - Starts the application.

### Router

You can add new routes in the `routes/web.php` file:

```php
$router->get('/home', [App\Controllers\HomeController::class, 'index']);
```

### Controller

To create a new controller, create a new PHP file in the `app/Controllers` directory:

```php
<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use Core\Response;
use Core\ViewRenderer;
use App\Services\HomeService;

class HomeController extends Controller
{
    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index(Request $request, Response $response)
    {
        $homeData = $this->homeService->getHomeData();
        $viewRenderer = new ViewRenderer('home/index', [
            'title' => $homeData->title,
            'message' => $homeData->message,
            'layout' => 'layout'
        ]);
        $viewRenderer->render();
    }
}
```

### Service

Services control the business logic. Create a new PHP file in the `app/Services` directory:

```php
<?php

namespace App\Services;

use App\Repositories\HomeRepository;

class HomeService
{
    protected $homeRepository;

    public function __construct(HomeRepository $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }

    public function getHomeData()
    {
        return $this->homeRepository->getHomeData();
    }
}
```

### Repository

Repositories control the data access layer. Create a new PHP file in the `app/Repositories` directory:

```php
<?php

namespace App\Repositories;

use App\Models\Home;

class HomeRepository
{
    public function getHomeData()
    {
        return new Home('Home Page', 'Welcome to My Bolt Framework!');
    }
}
```

### Model

Models represent the data structure. Create a new PHP file in the `app/Models` directory:

```php
<?php

namespace App\Models;

class Home
{
    public $title;
    public $message;

    public function __construct($title, $message)
    {
        $this->title = $title;
        $this->message = $message;
    }
}
```

### View

View files control the HTML content displayed to the user. Create new PHP files in the `app/Views` directory:

#### `app/Views/home/index.php`

```php
<main>
    <h1><?= $title ?? 'Default Title' ?></h1>
    <p><?= $message ?? 'Default Message' ?></p>
</main>
```

#### `app/Views/layout.php`

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Default Title' ?></title>
</head>
<body>
    <?= $content ?>
</body>
</html>
```

## Contributing

We welcome contributions! Please open an issue first to discuss any changes you would like to make.

1. Fork the repository
2. Create a new branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License. See the `LICENSE` file for more information.
