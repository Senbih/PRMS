<?php $__env->startSection('content'); ?>
<div>
    <div class="text-center font-semibold space-y-5 mb-3">
        <h3>Add User</h3>
        <?php if(Session::has('success')): ?>

        <?php echo e(Session::get('success')); ?>


        <?php endif; ?>
    </div>
    <div class="font-semibold text-right">
        <a href="<?php echo e(route('dept.users')); ?>">
            <button type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Back
            </button>
        </a>

    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <form action="<?php echo e(route('dept.store', $user)); ?>" method="POST" class="max-w-sm mx-auto mb-8">
            <?php echo csrf_field(); ?>
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User
                    Name</label>
                <input type="name" id="name" name="name" value="<?php echo e($user->name); ?>"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="name@flowbite.com" disabled />
                <input type="text" name="user_id" value="<?php echo e($user->id); ?>" hidden>
            </div>
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User
                    email</label>
                <input type="email" id="email" name="email" value="<?php echo e($user->email); ?>"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="name@flowbite.com" disabled />
            </div>
            <div class="mb-5">
                <label for="department_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Assign User to Department</label>

                <select name="department_id" id="department_id"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    required>
                    <option value="">Assign Department</option>
                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($department->id); ?>"><?php echo e(Str::ucfirst($department->name)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="mb-5">
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Assign User Role</label>

                <select name="role" id="role"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    required>
                    <option value="<?php echo e($user->role); ?>">
                        <?php if($user->role == 'teamleader'): ?>
                        Team Leader
                        <?php elseif($user->role == 'staff'): ?>
                        Staff
                        <?php else: ?>
                        <?php echo e(Str::ucfirst($user->role)); ?>

                        <?php endif; ?>
                    </option>
                    <option value="teamleader">Teamleader</option>
                    <option value="staff">Staff</option>
                </select>
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register
                to Department</button>
        </form>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leti\Desktop\PRMS - Copy\resources\views/admin/departmentUsers/create.blade.php ENDPATH**/ ?>