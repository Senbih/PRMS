

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Staff Plans</h2>
    <?php $__currentLoopData = $contents->reverse(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="bg-white shadow-md rounded-lg p-4 mb-6">
        <h3 class="text-xl font-bold mb-2">Title: <?php echo e($content->title); ?></h3>
        <p>Submitted by: <?php echo e($content->staff->name); ?></p>
        <p class="text-gray-700 mb-4">Description: <?php echo e($content->description); ?></p>
        <?php if($content->video): ?>
        <div class="mb-4">
            <video class="w-full max-w-md" controls>
                <source src="<?php echo e(asset('storage/' . $content->video)); ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <?php endif; ?>
        <?php if($content->document): ?>
        <a href="<?php echo e(asset('storage/' . $content->document)); ?>" class="text-blue-500 hover:underline mb-4 block" target="_blank">Download Document</a>
        <?php endif; ?>

        <div class="approval-status-container">
            <h4 class="approval-status-title">Approval Status:
                <span class="status <?php if($content->approval_status == 'approved'): ?> approved 
                            <?php elseif($content->approval_status == 'disapproved'): ?> disapproved 
                            <?php else: ?> pending 
                            <?php endif; ?>"><?php echo e(ucfirst($content->approval_status)); ?></span>
            </h4>
        </div>

        <!-- Approve/Disapprove Buttons -->
        <?php if($content->approval_status === 'pending'): ?>
        <div class="flex gap-4">
            <form action="<?php echo e(route('teamleader.approve-content', $content->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="approve-button">Approve</button>
            </form>
            <form action="<?php echo e(route('teamleader.disapprove-content', $content->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="disapprove-button">Disapprove</button>
            </form>
        </div>
        <?php endif; ?>

        <hr class="my-4">
        <h4 class="text-lg font-semibold mb-2">Comments</h4>
        <?php $__currentLoopData = $content->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <p class="text-gray-600 mb-2"><span class="font-semibold"><?php echo e($comment->user->name); ?>:</span> <?php echo e($comment->comment); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <!-- Add a comment -->
        <form action="<?php echo e(route('teamleader.add-comment', $content->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label for="comment" class="block text-sm font-medium text-gray-700">Add Comment</label>
                <textarea class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" id="comment" name="comment" required></textarea>
            </div>
            <button type="submit">Submit Comment</button>
        </form>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<style>
    .approve-button,
    .disapprove-button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        color: white;
        cursor: pointer;
        margin-right: 10px;
    }

    .approve-button {
        background-color: green;
    }

    .approve-button:hover {
        background-color: darkgreen;
    }

    .disapprove-button {
        background-color: red;
    }

    .disapprove-button:hover {
        background-color: darkred;
    }

    .approval-status-container {
        margin: 16px 0;
    }

    .approval-status-title {
        font-size: 1.125rem;
        /* Equivalent to text-lg */
        font-weight: 600;
        /* Equivalent to font-semibold */
        margin-bottom: 8px;
        /* Equivalent to mb-2 */
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
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.teamleader.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leti\Desktop\PRMS - Copy\resources\views/teamleader/view-content.blade.php ENDPATH**/ ?>