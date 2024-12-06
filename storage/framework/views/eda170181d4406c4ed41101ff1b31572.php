<?php $__env->startSection('content'); ?>
<div>
    <!-- Back Button -->


    <!-- Dashboard Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-9 p-6">
        <!-- Department Card -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <a href="<?php echo e(route('teamleader.mydepartment')); ?>">
                <div class="p-6">
                    <h3 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">
                        <?php if($departments == 1): ?>
                        <?php echo e($departments. ' Department'); ?>

                        <?php else: ?>
                        <?php echo e($departments. ' Departments'); ?>

                        <?php endif; ?>
                    </h3>
                    <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">Manage and view all your departments.</p>
                    <a href="<?php echo e(route('teamleader.mydepartment')); ?>"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-blue-200 rounded-full hover:bg-blue-300 focus:outline-none focus:ring-4 focus:ring-blue-300 shadow transition ease-in-out duration-300">
                        View Department
                        <svg class="ml-2 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </a>
        </div>

        <!-- Staff Card -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <a href="<?php echo e(route('teamleader.staffs')); ?>">
                <div class="p-6">
                    <h3 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">Staff</h3>
                    <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">Manage and view all your staff members.</p>
                    <a href="<?php echo e(route('teamleader.staffs')); ?>"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-blue-200 rounded-full hover:bg-blue-300 focus:outline-none focus:ring-4 focus:ring-blue-300 shadow transition ease-in-out duration-300">
                        View Staff
                        <svg class="ml-2 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </a>
        </div>

        <!-- Document Shared Card -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <a href="<?php echo e(route('department.contentlist')); ?>">
                <div class="p-6">
                    <h3 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">Document Shared</h3>
                    <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">Access and manage shared documents.</p>
                    <a href="<?php echo e(route('department.contentlist')); ?>"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-blue-200 rounded-full hover:bg-blue-300 focus:outline-none focus:ring-4 focus:ring-blue-300 shadow transition ease-in-out duration-300">
                        View Documents
                        <svg class="ml-2 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </a>
        </div>

        <!-- Staff Plans Card -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <a href="<?php echo e(route('teamleader.view-content')); ?>">
                <div class="p-6">
                    <h3 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">Staff Plans</h3>
                    <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">View and manage staff plans.</p>
                    <a href="<?php echo e(route('teamleader.view-content')); ?>"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-blue-200 rounded-full hover:bg-blue-300 focus:outline-none focus:ring-4 focus:ring-blue-300 shadow transition ease-in-out duration-300">
                        View Staff Plans
                        <svg class="ml-2 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </a>
        </div>

        <!-- Staff Reports Card -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <a href="<?php echo e(route('teamleader.view-staff-reports')); ?>">
                <div class="p-6">
                    <h3 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">Staff Reports</h3>
                    <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">View and manage staff reports.</p>
                    <a href="<?php echo e(route('teamleader.view-staff-reports')); ?>"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-blue-200 rounded-full hover:bg-blue-300 focus:outline-none focus:ring-4 focus:ring-blue-300 shadow transition ease-in-out duration-300">
                        View Staff Reports
                        <svg class="ml-2 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </a>
        </div>

        <!-- Create Plan Card -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <a href="<?php echo e(route('teamleader.create-plan-for-division')); ?>">
                <div class="p-6">
                    <h3 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">Create Plan</h3>
                    <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">Create new plans for your division.</p>
                    <a href="<?php echo e(route('teamleader.create-plan-for-division')); ?>"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-blue-200 rounded-full hover:bg-blue-300 focus:outline-none focus:ring-4 focus:ring-blue-300 shadow transition ease-in-out duration-300">
                        Create Plan
                        <svg class="ml-2 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </a>
        </div>

        <!-- Create Report Card -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <a href="<?php echo e(route('teamleader.create-report-for-division')); ?>">
                <div class="p-6">
                    <h3 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">Create Report</h3>
                    <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">Create new reports for your division.</p>
                    <a href="<?php echo e(route('teamleader.create-report-for-division')); ?>"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-blue-200 rounded-full hover:bg-blue-300 focus:outline-none focus:ring-4 focus:ring-blue-300 shadow transition ease-in-out duration-300">
                        Create Report
                        <svg class="ml-2 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </a>
        </div>

        <!-- My Plans Card -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <a href="<?php echo e(route('teamleader.my-plans')); ?>">
                <div class="p-6">
                    <h3 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">My Plans</h3>
                    <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">View and manage your personal plans.</p>
                    <a href="<?php echo e(route('teamleader.my-plans')); ?>"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-blue-200 rounded-full hover:bg-blue-300 focus:outline-none focus:ring-4 focus:ring-blue-300 shadow transition ease-in-out duration-300">
                        View My Plans
                        <svg class="ml-2 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </a>
        </div>

        <!-- My Reports Card -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <a href="<?php echo e(route('teamleader.my-reports')); ?>">
                <div class="p-6">
                    <h3 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">My Reports</h3>
                    <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">View and manage your personal reports.</p>
                    <a href="<?php echo e(route('teamleader.my-reports')); ?>"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800 bg-blue-200 rounded-full hover:bg-blue-300 focus:outline-none focus:ring-4 focus:ring-blue-300 shadow transition ease-in-out duration-300">
                        View My Reports
                        <svg class="ml-2 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.teamleader.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leti\Desktop\PRMS - Copy\resources\views/teamleader/dashboard.blade.php ENDPATH**/ ?>