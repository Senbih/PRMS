<?php $__env->startSection('content'); ?>
<div>
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

        <div class="relative border overflow-x-auto shadow-md sm:rounded-lg pt-3">
            <div class="text-center font-semibold space-y-5 mb-3">
                <h2>Documents</h2>
            </div>

            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Content
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Topic
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">

                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?php if(isset($content->video)): ?>
                            <a href="<?php echo e(asset($content->video)); ?>" target="blank">

                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M14 7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7Zm2 9.387 4.684 1.562A1 1 0 0 0 22 17V7a1 1 0 0 0-1.316-.949L16 7.613v8.774Z" clip-rule="evenodd" />
                                    <h3>Video</h3>
                                </svg>
                            </a>
                            <?php elseif(isset($content->document)): ?>
                            <a href="<?php echo e(asset($content->document)); ?>" target="blank">

                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M4 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-6-6H4Zm14 18H4V4h9v5h5v11ZM9 12h6v2H9v-2Zm0 4h6v2H9v-2Z" clip-rule="evenodd" />
                                    <h1>Document</h1>
                                </svg>
                            </a>
                            <?php else: ?>
                            <a href="<?php echo e($content->external_link); ?>" target="blank">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961" />
                                    <h3>External link</h3>
                                </svg>
                            </a>
                            <?php endif; ?>

                        </th>
                        <td class="px-6 py-4">
                            <?php echo e($content->topic); ?>

                        </td>
                        <td class="px-6 py-4">
                            <?php echo e($content->title); ?>

                        </td>
                        <td class="px-6 py-4">
                            <?php echo e($content->description); ?>


                        </td>
                        <td class="px-6 py-4">
                            <?php if(isset($content->video)): ?>
                            <div class="flex">
                                <a href="<?php echo e(asset('storage/' .$content->video)); ?>" target="blank"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    View
                                </a>
                            </div>
                            <?php elseif(isset($content->document)): ?>
                            <div class="flex">
                                <a href="<?php echo e(asset('storage/' . $content->document)); ?>" target="blank"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    View
                                </a>
                            </div>
                            <?php else: ?>
                            <div class="flex">
                                <a href="<?php echo e($content->external_link); ?>" target="blank"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    View
                                </a>
                            </div>
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
                <?php echo e($contents->links()); ?>

            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.staff.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leti\Desktop\PRMS - Copy\resources\views/staff/dashboard.blade.php ENDPATH**/ ?>