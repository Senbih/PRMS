<?php $__env->startSection('content'); ?>
<style>
    .main_bg {
        background-image: url("<?php echo e(asset('gold.jpg')); ?>");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        min-height: 100vh;
    }

    .logo-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin-top: 20px;
    }

    .logo {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .logo:hover {
        transform: scale(1.05);
    }

    h1 {
        color: #333;
        text-align: center;
    }
</style>
<div>
    <div class="flex items-center justify-center min-h-screen bg-blue-100 widt main_bg">
        <div>
            <div
                class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
                <div class="logo-container">
                    <div class="logo">
                        <img src="<?php echo e(asset('aastulogo.png')); ?>" alt="AASTU Logo" width="120" height="60">

                    </div>
                </div>
                <form class="space-y-6" action="<?php echo e(route('login')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <h5 class="text-xl font-medium text-gray-900 dark:text-white">Sign in to AASTU PRMS</h5>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            email</label>
                        <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" autofocus
                            autocomplete="username"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="name@company.com" required />
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            password</label>
                        <input type="password" name="password" id="password" autocomplete="current-password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="••••••••" required />
                        <div class="mt-2">
                            <input type="checkbox" id="togglePassword" class="mr-2">
                            <label for="togglePassword" class="text-sm font-medium text-gray-900 dark:text-white">Show
                                Password</label>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember_me" type="checkbox" value=""
                                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                                    name="remember_me" />
                            </div>
                            <label for="remember_me" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember
                                me &nbsp;&nbsp;</label>
                        </div>
                        <?php if(Route::has('password.request')): ?>
                        <a href="<?php echo e(route('password.request')); ?>" class="ms-auto text-sm text-blue-700 hover:underline dark:text-blue-500"> Lost
                            Password?</a>
                        <?php endif; ?>
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login
                        to your account</button>

                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    document.getElementById('togglePassword').addEventListener('change', function(e) {
        const passwordInput = document.getElementById('password');
        if (e.target.checked) {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.nuapp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leti\Desktop\PRMS - Copy\resources\views/auth/login.blade.php ENDPATH**/ ?>