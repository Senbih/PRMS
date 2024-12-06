
<?php $__env->startSection('content'); ?>
<div>
    <?php if(Session::has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(Session::get('success')); ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close"
            onclick="this.parentElement.style.display='none';">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <div class="relative border overflow-x-auto shadow-md sm:rounded-lg">
        <div class="text-center font-bold text-2xl space-y-5 mb-3">
            <h2>Vice president List</h2>
        </div>
        <form action="<?php echo e(route('president.search-vice_president')); ?>" method="GET" class="max-w-md mx-auto">
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
                    placeholder="Search name or email" required />
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>
        <div class="font-semibold text-right">

            <?php if(Route::is('president.vice_presidents')): ?>
            <a href="<?php echo e(route('president.dashboard')); ?>">
                <button type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Back
                </button>
            </a>
            <?php else: ?>
            <a href="<?php echo e(route('president.vice_presidents')); ?>">
                <button type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Back
                </button>
            </a>
            <?php endif; ?>
            </a>

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
                        Status
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $vice_presidents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">

                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo e($user->name); ?>

                    </th>
                    <td class="px-6 py-4">
                        <?php echo e($user->email); ?>

                    </td>
                    <td class="px-6 py-4">
                        <?php if($user->role == 'vice_president'): ?>
                        vice_president
                        <?php elseif($user->role == 'president'): ?>
                        president
                        <?php elseif($user->role == 'admin'): ?>
                        Admin
                        <?php else: ?>
                        Not Assigned
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4">
                        Assigned |
                        <?php if(array_key_exists($user->campus_id, $campusnames)): ?>
                        <?php echo e($campusnames[$user->campus_id]); ?>

                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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
            <?php echo e($vice_presidents->links()); ?>

        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.president.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leti\Desktop\PRMS - Copy\resources\views/president/campus.blade.php ENDPATH**/ ?>