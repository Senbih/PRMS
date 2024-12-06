
<?php $__env->startSection('content'); ?>
<div>
    <!-- Back Button (Optional) -->
    <div>
        
    </div>

    <!-- Dashboard Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
        <!-- campus Card -->
        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="<?php echo e(route('president.mycampus')); ?>">
                <h3 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                    <?php if($campuses == 1): ?>
                    <?php echo e($campuses. ' '.'Campus'); ?>

                    <?php else: ?>
                    <?php echo e($campuses. ' '.'campuses'); ?>

                    <?php endif; ?>
                </h3>
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"></p>
            <a href="<?php echo e(route('president.mycampus')); ?>"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                View Campus
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                        clip-rule="evenodd" />
                    <path fill-rule="evenodd"
                        d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        </div>

        <!-- Add Separate Cards for Each Dropdown Option -->
        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="<?php echo e(route('president.vice_presidents')); ?>">
                <h3 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">vice president</h3>
            </a>
            <a href="<?php echo e(route('president.vice_presidents')); ?>"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">View vice president</a>
        </div>

        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="<?php echo e(route('campus.contentlist')); ?>">
                <h3 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Document Shared</h3>
            </a>
            <a href="<?php echo e(route('campus.contentlist')); ?>"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">View Documents</a>
        </div>

        <!-- Repeat for Each Link -->
        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="<?php echo e(route('president.view-content')); ?>">
                <h3 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Vice presidents Plans</h3>
            </a>
            <a href="<?php echo e(route('president.view-content')); ?>"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">View Vice president Plans</a>
        </div>


        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="<?php echo e(route('president.view-vice_president-reports')); ?>">
                <h3 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Vice presidents Reports</h3>
            </a>
            <a href="<?php echo e(route('president.view-vice_president-reports')); ?>"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">View Vice president Reports</a>
        </div>




    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.president.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leti\Desktop\PRMS - Copy\resources\views/president/dashboard.blade.php ENDPATH**/ ?>