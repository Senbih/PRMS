<?php $__env->startSection('content'); ?>
<div class="container mx-auto">
    <div class="text-center font-semibold space-y-5 mb-3">
        <h3>Edit Department - <?php echo e($department->name); ?></h3>
    </div>

    <!-- Form to edit department name -->
    <form action="<?php echo e(route('department.update', $department->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="mb-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Department Name</label>
            <input type="text" id="name" name="name" value="<?php echo e($department->name); ?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5" placeholder="Department Name" required>
        </div>

        <!-- Dropdown to assign Team Leader -->
        <div class="mb-5">
            <label for="teamleader_id" class="block mb-2 text-sm font-medium text-gray-900">Assign Team Leader</label>
            <select id="teamleader_id" name="teamleader_id" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5">
                <option value="">Select a Team Leader</option>
                <?php $__currentLoopData = $teamLeaders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teamLeader): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($teamLeader->id); ?>" <?php echo e($teamLeader->id == $department->teamleader_id ? 'selected' : ''); ?>>
                    <?php echo e($teamLeader->name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Button to save department changes -->
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 mb-8">Update Department</button>
    </form>

    <!-- Table to list users in the department -->
    <div class="relative border overflow-x-auto shadow-md sm:rounded-lg mt-8">
        <div class="text-center font-bold text-2xl space-y-5 mb-3">
            <h4>Users in <?php echo e($department->name); ?></h4>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Role</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo e($user->name); ?>

                    </th>
                    <td class="px-6 py-4"><?php echo e($user->email); ?></td>
                    <td class="px-6 py-4">
                        <?php echo e(ucfirst($user->role)); ?>

                    </td>
                    <td class="flex px-6 py-4">
                        <a href="<?php echo e(route('admin.user-edit', $user)); ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        <?php if($user->role == 'teamleader'): ?>
                        <form action="<?php echo e(route('department.assignTeamLeader', ['department' => $department->id])); ?>" method="POST" class="inline-block ml-2">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="teamleader_id" value="<?php echo e($user->id); ?>">
                            <button type="submit" class="text-green-600 hover:underline">| Assign as Team Leader</button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leti\Desktop\PRMS - Copy\resources\views/admin/departments/edit.blade.php ENDPATH**/ ?>