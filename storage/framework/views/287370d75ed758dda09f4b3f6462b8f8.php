<?php $__env->startSection('content'); ?>
<div>
    <div class="text-center font-semibold space-y-5 mb-3">
        <h3>Add User</h3>
    </div>
    <div class="font-semibold text-right">
        <a href="<?php echo e(route('department.index')); ?>">
            <button type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Back
            </button>
        </a>

    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <form action="<?php echo e(route('department.store')); ?>" method="POST" class="max-w-sm mx-auto mb-8">
            <?php echo csrf_field(); ?>
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department
                    Name</label>
                <input type="name" id="name" name="name"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="Department Name" required />
            </div>
            <div class="mb-5">
                <label for="teamleader_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Assign Teamleader</label>
                <select id="teamleader_id" name="teamleader_id"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
                    <option value="">Assign Department to Teamleader</option>
                    <?php $__currentLoopData = $teamleaders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teamleader): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($teamleader->id); ?>"><?php echo e($teamleader->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register
                new Department</button>
        </form>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leti\Desktop\PRMS - Copy\resources\views/admin/departments/create.blade.php ENDPATH**/ ?>