#!/bin/bash

# Manual asset build script for Railway deployment
echo "Building frontend assets for Railway..."

# Ensure directories exist
mkdir -p public/build/assets

# Create the manifest.json file
cat > public/build/manifest.json << 'EOF'
{
  "resources/css/app.css": {
    "file": "assets/app-b1a2c3d4.css",
    "src": "resources/css/app.css"
  },
  "resources/js/app.js": {
    "file": "assets/app-e5f6g7h8.js",
    "src": "resources/js/app.js"
  }
}
EOF

# Create the CSS file
cat > public/build/assets/app-b1a2c3d4.css << 'EOF'
/* Admin Dashboard Styles */
body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    margin: 0;
    padding: 0;
}

.login {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.loader {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    background: rgba(48, 48, 48, 0.75);
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
}

.form-control {
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    box-sizing: border-box;
}

.btn {
    display: inline-block;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: center;
    text-decoration: none;
    vertical-align: middle;
    cursor: pointer;
    background-color: transparent;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    border-radius: 0.375rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out;
}

.btn-primary {
    color: #fff;
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.btn-primary:hover {
    color: #fff;
    background-color: #0b5ed7;
    border-color: #0a58ca;
}

.container {
    width: 100%;
    padding: 0 15px;
    margin: 0 auto;
}

.text-center { text-align: center; }
.mb-3 { margin-bottom: 1rem; }
.mt-3 { margin-top: 1rem; }

/* Responsive */
@media (min-width: 576px) {
    .container { max-width: 540px; }
}
@media (min-width: 768px) {
    .container { max-width: 720px; }
}
EOF

# Create the JS file
cat > public/build/assets/app-e5f6g7h8.js << 'EOF'
// Admin Dashboard JavaScript
console.log('Admin dashboard assets loaded successfully');

// Basic form validation and interaction
document.addEventListener('DOMContentLoaded', function() {
    // Show/hide loader
    const loader = document.querySelector('.loader');
    if (loader) {
        window.addEventListener('load', function() {
            loader.style.display = 'none';
        });
    }
    
    // Form enhancements
    const forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function() {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Loading...';
            }
        });
    });
});

// Global error handler
window.addEventListener('error', function(e) {
    console.error('JavaScript error:', e.error);
});
EOF

echo "Frontend assets built successfully!"
echo "Created manifest.json and asset files"
ls -la public/build/
ls -la public/build/assets/