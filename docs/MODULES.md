# Module Development Guide

## Overview
Modules are self-contained applications within the Portal ecosystem, designed to be modular, reusable, and easily integrated.

## Module Types
### Blade-based Modules
- Pure Laravel Blade templates
- Minimal JavaScript interaction
- Recommended for simple, content-driven modules

### Livewire/Alpine Modules
- Interactive components
- Real-time updates
- Complex user interactions

## Module Structure
```
Modules/
└── ModuleName/
    ├── Config/
    ├── Database/
    │   ├── Migrations/
    │   └── Seeders/
    ├── Http/
    │   ├── Controllers/
    │   ├── Middleware/
    │   └── Requests/
    ├── Resources/
    │   ├── assets/
    │   ├── lang/
    │   └── views/
    ├── Routes/
    ├── Tests/
    └── module.json
```

## Roles and Permissions

### Overview
Portal provides a flexible, centralized permissions system that allows module creators to define custom roles and permissions for their specific module.

### Implementing Module Permissions

#### Step 1: Create Permission Registrar
Each module must create a `PermissionRegistrar` class that implements the `ModulePermissionInterface`:

```php
// Modules/YourModule/PermissionRegistrar.php
namespace Modules\YourModule;

use App\Contracts\ModulePermissionInterface;
use App\Services\PermissionManager;

class PermissionRegistrar implements ModulePermissionInterface
{
    public function registerPermissions(PermissionManager $permissionManager): void
    {
        // Register module-specific permissions
        $permissionManager->registerModulePermissions('your_module', [
            // Define possible actions
            'view' => 'View module content',
            'create' => 'Create new items',
            'edit' => 'Edit existing items',
            'delete' => 'Delete items',
            'manage_settings' => 'Manage module settings'
        ]);

        // Register module-specific roles
        $permissionManager->registerModuleRoles('your_module', [
            // Define roles and their associated permissions
            'administrator' => [
                'view', 'create', 'edit', 'delete', 'manage_settings'
            ],
            'editor' => [
                'view', 'create', 'edit'
            ],
            'viewer' => [
                'view'
            ]
        ]);
    }
}
```

#### Step 2: Permission Naming Conventions
- Permissions are namespaced with the module name
- Use lowercase, snake_case for permission keys
- Provide a human-readable description

#### Step 3: Checking Permissions in Controllers

```php
namespace Modules\YourModule\Http\Controllers;

class YourController extends Controller
{
    public function create()
    {
        // Check module-specific permission
        $this->authorize('your_module.create');
        
        // Controller logic
    }

    public function edit()
    {
        // Check module-specific permission
        $this->authorize('your_module.edit');
        
        // Controller logic
    }
}
```

#### Step 4: Middleware Protection

```php
// In routes file
Route::middleware(['permission:your_module.view'])
    ->group(function () {
        // Routes only accessible with 'view' permission
    });
```

### Checking Permissions in Blade Templates

Blade provides several directives for checking permissions in your views:

#### Basic Permission Check
```blade
@can('module_name.permission_key')
    <!-- Content visible only to users with specific permission -->
    <button>Perform Action</button>
@endcan
```

#### Else Condition
```blade
@can('module_name.permission_key')
    <button>Perform Action</button>
@else
    <p>You do not have permission to perform this action.</p>
@endcan
```

#### Multiple Permission Check
```blade
@canany(['module_name.permission1', 'module_name.permission2'])
    <!-- Content visible if user has either permission -->
    <div>Authorized Content</div>
@endcanany
```

#### Inverse Permission Check
```blade
@cannot('module_name.permission_key')
    <p>This content is shown when the user lacks the permission</p>
@endcannot
```

#### Conditional Rendering
```blade
@if(auth()->user()->can('module_name.permission_key'))
    <!-- Alternative way to check permissions -->
    <div>Conditional Content</div>
@endif
```

#### Best Practices
- Always validate permissions server-side
- Use the most specific permission possible
- Provide clear feedback when permissions are denied
- Consider user experience when hiding/showing elements

### Assigning Roles to Users

#### From User Model
```php
// Assign a module-specific role to a user
$user->assignModuleRole('your_module', 'editor');
```

#### From Admin Interface
Implement a role assignment interface in your module that allows administrators to:
- View existing roles
- Assign roles to users
- Create custom roles with specific permissions

### Best Practices
- Define the minimum set of permissions needed
- Use the principle of least privilege
- Provide clear, descriptive permission names
- Avoid overly broad permissions
- Consider hierarchical permissions

### Common Pitfalls to Avoid
- Don't create too many granular permissions
- Ensure permissions make logical sense
- Keep permission names consistent
- Document the purpose of each permission

### Debugging Permissions
Use these methods to inspect user permissions:

```php
// Get all permissions for a user
$userPermissions = auth()->user()->permissions;

// Check if user has a specific permission
$hasPermission = auth()->user()->can('your_module.view');

// Get user's roles
$userRoles = auth()->user()->roles;
```

### Module Permission Lifecycle
1. Module is installed
2. `PermissionRegistrar` is called
3. Permissions and roles are registered in the system
4. Administrators can assign roles
5. Middleware and authorization checks enforce permissions

### Extending Permissions Dynamically
Modules can add or modify permissions at runtime using the `PermissionManager` service.

### Security Considerations
- Always validate permissions server-side
- Never trust client-side permission checks
- Regularly audit and review module permissions
- Use strong authentication mechanisms

## Navigation Integration
- Define navigation items in `module.json`
- Implement `ModuleNavigationProvider`
- Specify section (Applications, Tools, Admin)

## Audit Logging
- Implement `AuditLogInterface`
- Use centralized logging mechanism
- Log critical actions and events

## Best Practices
- Keep modules loosely coupled
- Use dependency injection
- Follow Laravel coding standards
- Write comprehensive tests
- Document module functionality

## Module Development Workflow
1. Create module scaffold
2. Implement core functionality
3. Define roles and permissions
4. Add navigation items
5. Implement audit logging
6. Write tests
7. Document module
