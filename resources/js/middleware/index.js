// middleware.js

// Middleware function to require authentication
export function requireAuth(to, from, next) {
    // Check if the user is authenticated
    if (!localStorage.getItem('token')) {
        // Redirect to the login page if not authenticated
        next('/login');
    } else {
        // Continue to the next route if authenticated
        next();
    }
}

// Middleware function to require admin authentication
export function requireAdminAuth(to, from, next) {
// Check if the user is authenticated and is an admin or superadmin
    if (!localStorage.getItem('token') || (localStorage.getItem('role') !== 'admin')) {
        // Redirect to the login page if not authenticated or not an admin/superadmin
        next('/login');
    } else {
        // Continue to the next route if authenticated and is an admin or superadmin
        next();
    }

    }

// Middleware function to prevent user access to admin routes
export function preventUserAccess(to, from, next) {
    // Check if the user is authenticated and is a user
    if (localStorage.getItem('token') && localStorage.getItem('role') === 'user') {
        // Redirect to the dashboard or any other appropriate route for users
        next('/dashboard');
    } else {
        // Continue to the next route if not a user
        next();
    }
}
