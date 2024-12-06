

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">My Submitted Report</h2>
    <?php $__currentLoopData = $reports->reverse(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="report-item bg-white shadow-md rounded-lg p-6 mb-6">
        <h3 class="text-xl font-semibold mb-2"> Report Title: <?php echo e($report->title); ?></h3>
        <p class="text-gray-700 mb-4">Report description: <?php echo e($report->description); ?></p>
        <p class="approval-Status">Approval Status:
            <span class="status <?php if($report->approval_status == 'approved'): ?> approved 
                        <?php elseif($report->approval_status == 'disapproved'): ?> disapproved
                        <?php else: ?> pending
                        <?php endif; ?>"><?php echo e(ucfirst($report->approval_status)); ?></span>
        </p>
        <?php if($report->document): ?>
        <a href="<?php echo e(asset('storage/' . $report->document)); ?>" class="text-blue-500 hover:underline mb-4 block">Download Document</a>
        <?php endif; ?>
        <hr class="my-4">
        <h4 class="text-lg font-medium mb-2">Comments from Team Leader</h4>
        <?php $__empty_1 = true; $__currentLoopData = $report->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <p class="text-gray-800 mb-2"><strong><?php echo e($comment->user->name); ?></strong>: <?php echo e($comment->comment); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-gray-500">No comments yet.</p>
        <?php endif; ?>

        <!-- Delete button -->
        <form action="<?php echo e(route('staff.delete-report', $report->id)); ?>" method="POST" class="mt-4">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this report?');">Delete Report</button>
        </form>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<style>
    .approval-status {
        font-weight: 500;
        margin-bottom: 10px;
    }

    .status {
        font-weight: bold;
    }

    .status.approved {
        color: green;
    }

    .status.disapproved {
        color: red;
    }

    .status.pending {
        color: yellow;
    }

    .delete-button {
        background-color: red;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .delete-button:hover {
        background-color: darkred;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.staff.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leti\Desktop\PRMS - Copy\resources\views/staff/my-reports.blade.php ENDPATH**/ ?>