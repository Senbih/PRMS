
<?php $__env->startSection('content'); ?>
<div class="container mx-auto">
    <div class="text-center font-semibold space-y-5 mb-3">
        <h3>Edit Campus - <?php echo e($campus->name); ?></h3>
    </div>

    <!-- Form to edit campus name -->
    <form action="<?php echo e(route('campus.update', $campus->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="mb-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Campus Name</label>
            <input type="text" id="name" name="name" value="<?php echo e($campus->name); ?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5" placeholder="campus Name" required>
        </div>

        <!-- Dropdown to assign President -->
        <div class="mb-5">
            <label for="president_id" class="block mb-2 text-sm font-medium text-gray-900">Assign President</label>
            <select id="president_id" name="president_id" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5">
                <option value="">Select a Vice President</option>
                <?php $__currentLoopData = $presidents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $president): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($president->id); ?>" <?php echo e($president->id == $campus->president_id ? 'selected' : ''); ?>>
                    <?php echo e($president->name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <!-- Button to save campus changes -->
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 mb-8">Update campus</button>
    </form>

    <!-- Table to list divisions in the campus -->
    <div class="relative border overflow-x-auto shadow-md sm:rounded-lg mt-8">
        <div class="text-center font-bold text-2xl space-y-5 mb-3">
            <h4>Offices in <?php echo e($campus->name); ?></h4>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Vice President</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $offices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $office): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo e($office->name); ?>

                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo e($office->vice_president_name); ?>

                    </th>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leti\Desktop\PRMS - Copy\resources\views/admin/campuses/edit.blade.php ENDPATH**/ ?>