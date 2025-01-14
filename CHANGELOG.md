# Changelog
All notable changes to this project will be documented in this file.

## [0.3.3] - 2025-01-14
### Added
- User status management feature
  - Added ability to activate/deactivate user accounts
  - Added middleware to prevent inactive users from accessing the system
  - Added status checks during authentication
  - Added visual indicators for user status in the user list

### Security
- Improved access control by preventing inactive users from logging in
- Added automatic logout for deactivated users

## [0.3.2] - 2025-01-14
### Fixed
- Fixed middleware registration in Laravel 11 by using fully qualified class names
- Resolved "Target class [role] does not exist" error in role middleware
- Fixed user management view by switching from component-based to Blade template inheritance
- Updated route middleware to use `RoleMiddleware::class` instead of string alias

## [0.3.1] - 2025-01-14
### Fixed
- Resolved missing service providers issues
- Added missing route files
- Fixed RouteServiceProvider configuration
- Corrected Laravel application bootstrap configuration

### Added
- Created missing EventServiceProvider
- Created missing AuthServiceProvider
- Created missing RouteServiceProvider

## [0.3.0] - 2025-01-14
### Added
- Integrated Spatie Laravel-permission package for robust role and permission management
- Centralized permission system for Portal and modules
- Module-specific role and permission registration
- Comprehensive permission checking in controllers, routes, and Blade templates

### Changed
- Enhanced module architecture to support dynamic permission registration
- Updated module development guidelines for role and permission implementation

### Improvements
- Added flexibility for module creators to define custom roles and permissions
- Implemented granular access control mechanisms
- Improved security and access management across the Portal ecosystem

## [0.2.0] - 2025-01-10
### Added
- Unified, responsive navigation system
- Dashboard link with icon in navigation
- Support for multiple content rendering methods (Blade components, traditional Blade, Livewire)
- Flexible layout supporting `$slot`, `$content`, and `@yield('content')`

### Changed
- Consolidated mobile and desktop navigation into a single, responsive partial
- Simplified layout structure in `app.blade.php`
- Improved header and navigation positioning

### Removed
- Separate mobile and desktop navigation files
- Redundant navigation code

## [0.1.0] - 2024-XX-XX
### Added
- Initial project setup
- Laravel Fortify authentication
- Basic project structure

### Planned
- Module system implementation
- Role-based access control
- Audit logging system
