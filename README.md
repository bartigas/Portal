# Portal Project

## Overview
A modular web portal built with Laravel 11, designed to host multiple applications with robust authentication, role-based access control, and flexible module architecture.

## Version
**Current Version: 0.2.0**

## What's New in 0.2.0
- Unified, responsive navigation system
- Dashboard link with icon in navigation
- Enhanced layout flexibility
- Support for multiple content rendering methods

## Documentation
Detailed documentation can be found in the `docs/` directory:
- [ROADMAP](docs/ROADMAP.md): Project vision and long-term goals
- [TODO](docs/TODO.md): Current tasks and progress tracking
- [ARCHITECTURE](docs/ARCHITECTURE.md): System design and technical details
- [MODULES](docs/MODULES.md): Guide for module development
- [SECURITY](docs/SECURITY.md): Security considerations and practices
- [CHANGELOG](CHANGELOG.md): Detailed version history

## Key Features
- Modular application architecture
- Comprehensive authentication system
- Role-based access control
- Audit logging
- Flexible UI support
  - Blade components
  - Traditional Blade views
  - Livewire components
  - Alpine.js interactions
- Mobile-responsive design
- Customizable navigation

## Layout Rendering Methods
Portal supports multiple content rendering methods:

1. Blade Component `$slot`:
```blade
<x-app-layout>
    <!-- Content here -->
</x-app-layout>
```

2. Blade Component `$content`:
```blade
<x-app-layout>
    <x-slot:content>
        <!-- Content here -->
    </x-slot:content>
</x-app-layout>
```

3. Traditional Blade `@yield('content')`:
```blade
@extends('layouts.app')

@section('content')
    <!-- Content here -->
@endsection
```

## Installation

### Prerequisites
- PHP 8.1+
- Composer
- Node.js and npm

### Steps
1. Clone the repository
```bash
git clone https://github.com/yourusername/portal.git
cd portal
```

2. Install PHP dependencies
```bash
composer install
```

3. Install JavaScript dependencies
```bash
npm install
npm run dev
```

4. Copy environment file and generate key
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database in `.env`

6. Run migrations
```bash
php artisan migrate
```

## Running the Application
```bash
php artisan serve
```

## Contributing
Please read our [CONTRIBUTING.md](docs/CONTRIBUTING.md) for details on our code of conduct and the process for submitting pull requests.

## License
This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
