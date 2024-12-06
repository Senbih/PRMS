

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Create Report for Division</h2>
    <form action="<?php echo e(route('teamleader.store-report-for-division')); ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="topic" class="block text-sm font-medium text-gray-700">Topic</label>
            <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" id="topic" name="topic" required>
        </div>
        <div class="form-group">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="document" class="block text-sm font-medium text-gray-700">Document</label>
            <input type="file" class="mt-1 block w-full text-gray-700" id="document" name="document" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.csv,.jpg,.jpeg,.png,.gif,.svg,.zip,.rar">
        </div>
        <div class="form-group">
            <label for="division" class="block text-sm font-medium text-gray-700">Division</label>
            <input type="text" class="mt-1 block w-full border-gray-300 rounded-md bg-gray-100 text-gray-700" value="<?php echo e($division->name); ?>" readonly>
            <input type="hidden" name="division_id" value="<?php echo e($division->id); ?>">
        </div>
        <button type="submit" class="bg-blue-500 text-dark px-4 py-2 rounded-md hover:bg-blue-600">Submit</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.teamleader.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leti\Desktop\PRMS - Copy\resources\views/teamleader/create-report-for-division.blade.php ENDPATH**/ ?>