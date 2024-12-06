<?php $__env->startSection('content'); ?>
<?php if(Session::has('success')): ?>
<div class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
    role="alert">
    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
        fill="currentColor" viewBox="0 0 20 20">
        <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
    </svg>
    <span class="sr-only">Info</span>
    <div>
        <span class="font-medium">Info alert!</span> <?php echo e(Session::get('success')); ?>

    </div>
</div>
<div>
    <?php endif; ?>


    <div class="relative border overflow-x-auto shadow-md sm:rounded-lg">
        <div class="text-center font-bold text-2xl space-y-5 mb-3">
            <h2>User List</h2>
        </div>
        <form action="<?php echo e(route('admin.search-user')); ?>" method="GET" class="max-w-md mx-auto mb-3">
            <?php echo csrf_field(); ?>
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input name="search" type="search" id="default-search"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search User" required />
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>

        <div class="font-semibold text-right">
            <a href="<?php echo e(route('admin.users-create')); ?>">
                <button type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Add User
                </button>
            </a>
            <?php if(Route::is('admin.users')): ?>
            <a href="<?php echo e(route('admin.dashboard')); ?>">
                <button type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Back
                </button>
            </a>
            <?php else: ?>
            <a href="<?php echo e(route('admin.users')); ?>">
                <button type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Back
                </button>
            </a>
            <?php endif; ?>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        User name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo e($user->name); ?>

                    </th>
                    <td class="px-6 py-4">
                        <?php echo e($user->email); ?>

                    </td>
                    <td class="px-6 py-4">
                        <?php if($user->role == 'teamleader'): ?>
                        Team Leader
                        <?php elseif($user->role == 'staff'): ?>
                        Staff
                        <?php elseif($user->role == 'vice_president'): ?>
                        Vice President
                        <?php elseif($user->role == 'president'): ?>
                        President
                        <?php elseif($user->role == 'director'): ?>
                        Director
                        <?php else: ?>
                        <?php echo e($user->role); ?>

                        <?php endif; ?>
                    </td>

                    <td class="flex px-6 py-4">
                        <div>
                            <form method="POST" action="<?php echo e(route('admin.user-delete', $user)); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <a href="<?php echo e(route('admin.user-edit', $user)); ?>"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit |</a>

                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this User?');">Delete
                                </button>
                            </form>
                        </div>

                        <form method="POST" action="<?php echo e(route('admin.user-reset', $user)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <button type="submit" class="text-green-600 hover:text-red-900"> | Reset Password
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        No data
                    </th>
                    <td class="px-6 py-4">
                        No data
                    </td>
                    <td class="px-6 py-4">
                        No data
                    </td>
                    <td class="px-6 py-4">
                        No data
                    </td>
                    <td class="px-6 py-4">
                        No Data
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="text-center">
            <?php echo e($users->links()); ?>

        </div>

    </div>

    
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leti\Desktop\PRMS - Copy\resources\views/admin/user/index.blade.php ENDPATH**/ ?>