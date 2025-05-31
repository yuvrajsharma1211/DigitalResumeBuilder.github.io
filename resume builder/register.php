<?php
    $title = "Register | resume builder";
    require './assets/include/header.php';
    $fn->nonAuthPage();
?>
<!-- Tailwind CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-slate-50 via-indigo-100 to-white px-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
        <form method="POST" action="actions/register.action.php">
            <div class="flex items-center gap-4 justify-center mb-6">
                <img src="./assets/images/logo.png" alt="Logo" class="h-16 w-16 rounded-full shadow-md">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800"><b>Resume</b> Builder</h1>
                    <p class="text-sm text-gray-500">Create your new account</p>
                </div>
            </div>

            <div class="mb-4">
                <label for="floatingName" class="block text-sm font-medium text-gray-700 mb-1"><i class="bi bi-person"></i> Full Name</label>
                <input type="text" name="full_name" id="floatingName" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-300 focus:border-indigo-300 focus:outline-none shadow-sm" />
            </div>

            <div class="mb-4">
                <label for="floatingEmail" class="block text-sm font-medium text-gray-700 mb-1"><i class="bi bi-envelope"></i> Email address</label>
                <input type="email" name="email_id" id="floatingEmail" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-300 focus:border-indigo-300 focus:outline-none shadow-sm" />
            </div>

            <div class="mb-6">
                <label for="floatingPassword" class="block text-sm font-medium text-gray-700 mb-1"><i class="bi bi-key"></i> Password</label>
                <input type="password" name="password" id="floatingPassword" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-300 focus:border-indigo-300 focus:outline-none shadow-sm" />
            </div>

            <button type="submit"
                    class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 rounded-lg shadow-md transition duration-200">
                <i class="bi bi-person-plus-fill"></i> Register
            </button>

            <div class="flex justify-between items-center mt-4 text-sm">
                <a href="forgot-password.php" class="text-gray-600 hover:text-indigo-600">Forgot Password?</a>
                <a href="login.php" class="text-gray-600 hover:text-indigo-600">Login</a>
            </div>
        </form>
    </div>
</div>

<?php
    require './assets/include/footer.php';
?>
