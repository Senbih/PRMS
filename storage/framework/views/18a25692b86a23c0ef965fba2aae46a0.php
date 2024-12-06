

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">My Plans</h2>
    <div class="relative border overflow-x-auto shadow-md sm:rounded-lg pt-3">
        <?php $__currentLoopData = $plans->reverse(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="content-item bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-xl font-semibold mb-2">Plan Topic: <?php echo e($plan->topic); ?></h3>
            <h3 class="text-xl font-semibold mb-2">Plan Title: <?php echo e($plan->title); ?></h3>
            <p class="text-gray-700 mb-4">Plan Description: <?php echo e($plan->description); ?></p>

            <!-- Approval Status -->
            <p class="approval-status mb-4">Approval Status:
                <span class="status <?php if($plan->approval_status == 'approved'): ?> approved 
                            <?php elseif($plan->approval_status == 'disapproved'): ?> disapproved
                            <?php else: ?> pending 
                            <?php endif; ?>"><?php echo e(ucfirst($plan->approval_status)); ?></span>
            </p>

            <!-- Optional: Display Video or Document if exists -->
            <?php if($plan->video): ?>
            <div class="mb-4">
                <video class="w-full max-w-md" controls>
                    <source src="<?php echo e(asset('storage/' . $plan->video)); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <?php endif; ?>

            <?php if($plan->document): ?>
            <a href="<?php echo e(asset('storage/' . $plan->document)); ?>" class="text-blue-500 hover:underline mb-4 block">Download Document</a>
            <?php endif; ?>

            <!-- Comments Section -->
            <hr class="my-4">
            <h4 class="text-lg font-medium mb-2">Comments from Director</h4>
            <?php $__empty_1 = true; $__currentLoopData = $plan->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <p class="text-gray-800 mb-2"><strong><?php echo e($comment->user->name); ?></strong>: <?php echo e($comment->comment); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-gray-500">No comments yet.</p>
            <?php endif; ?>

            <!-- Delete Button -->
            <form action="<?php echo e(route('teamleader.delete-plan', $plan->id)); ?>" method="POST" class="mt-4">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this plan?');">Delete Plan</button>
            </form>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
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
        color: orange;
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
<?php echo $__env->make('layouts.teamleader.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leti\Desktop\PRMS - Copy\resources\views/teamleader/my-plans.blade.php ENDPATH**/ ?>