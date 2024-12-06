<?php $__env->startSection('content'); ?>
<div class="p-4">
  <!-- Grid for Main Dashboard Buttons -->
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-4">
    <!-- Overview Button -->
    <div class="flex items-center justify-center border rounded-lg h-32 md:h-64 bg-blue-600 text-black hover:shadow-xl transition-shadow duration-200">
      <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex flex-col items-center p-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4l3 3 4-8 5 10H3z" />
        </svg>
        <span class="text-lg font-semibold">Overview</span>
      </a>
    </div>


    <!-- User Management Button -->
    <div class="flex items-center justify-center border rounded-lg h-32 md:h-64 bg-green-600 text-black hover:shadow-xl transition-shadow duration-200">
      <a href="<?php echo e(route('admin.users')); ?>" class="flex flex-col items-center p-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V5a4 4 0 00-8 0v6m8 4H4m12 0a4 4 0 01-8 0" />
        </svg>
        <span class="text-lg font-semibold">User Management</span>
      </a>
    </div>

    <!-- Department Management Button -->
    <div class="flex items-center justify-center border rounded-lg h-32 md:h-64 bg-yellow-600 text-black hover:shadow-xl transition-shadow duration-200">
      <a href="<?php echo e(route('department.index')); ?>" class="flex flex-col items-center p-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m-9-6l9 5 9-5" />
        </svg>
        <span class="text-lg font-semibold">Department Management</span>
      </a>
    </div>

    <!-- Workflow Management Button -->
    <div class="flex items-center justify-center border rounded-lg h-32 md:h-64 bg-purple-600 text-black hover:shadow-xl transition-shadow duration-200">
      <a href="<?php echo e(route('dept.users')); ?>" class="flex flex-col items-center p-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h6m0 0a1 1 0 011 1v2a1 1 0 01-1 1H3a1 1 0 01-1-1V8a1 1 0 011-1zm7 8h4m0 0a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1v-2a1 1 0 011-1zm6-4h6m0 0a1 1 0 011 1v2a1 1 0 01-1 1h-6a1 1 0 01-1-1v-2a1 1 0 011-1z" />
        </svg>
        <span class="text-lg font-semibold">Workflow Management</span>
      </a>
    </div>
  </div>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-4">
    <div class="flex items-center justify-center border rounded-lg h-32 md:h-64 bg-blue-600 text-black hover:shadow-xl transition-shadow duration-200">
      <a href="<?php echo e(route('division.index')); ?>" class="flex flex-col items-center p-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18v18H3V3z" />
        </svg>
        <span class="text-lg font-semibold">Division Management</span>
      </a>
    </div>

    <div class="flex items-center justify-center border rounded-lg h-32 md:h-64 bg-green-600 text-black hover:shadow-xl transition-shadow duration-200">
      <a href="<?php echo e(route('office.index')); ?>" class="flex flex-col items-center p-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 2h12v20H6V2z" />
        </svg>
        <span class="text-lg font-semibold">Office Management</span>
      </a>
    </div>

    <!-- Department Management Button -->
    <div class="flex items-center justify-center border rounded-lg h-32 md:h-64 bg-blue-600 text-black hover:shadow-xl transition-shadow duration-200">
      <a href="<?php echo e(route('campus.index')); ?>" class="flex flex-col items-center p-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l7 7-7 7-7-7 7-7z" />
        </svg>
        <span class="text-lg font-semibold">Campus Management</span>
      </a>
    </div>

  </div>


</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leti\Desktop\PRMS - Copy\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>