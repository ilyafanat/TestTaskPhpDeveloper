
<?php $__env->startSection('title', 'Game History'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container mx-auto p-4 md:p-8 max-w-4xl">
        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="flex justify-between items-center mb-6 border-b pb-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Game History</h2>
                    <p class="text-gray-600">Showing all plays for <?php echo e($user->username); ?></p>
                </div>
                <a href="<?php echo e(route('access.page', ['token' => $link->token])); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md transition duration-150">
                    &larr; Back to Game
                </a>
            </div>

             <?php if(count($history) > 0): ?>
                <div class="space-y-4">
                    <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-4 rounded-lg <?php if($item->outcome === 'Win'): ?> bg-green-50 <?php else: ?> bg-red-50 <?php endif; ?> border <?php if($item->outcome === 'Win'): ?> border-green-200 <?php else: ?> border-red-200 <?php endif; ?> flex justify-between items-center">
                            <div>
                                <p class="font-semibold">
                                    <span class="text-gray-800">Number:</span> <span class="text-blue-600"><?php echo e($item->number); ?></span> |
                                    <span class="text-gray-800">Outcome:</span> <span class="font-bold <?php if($item->outcome === 'Win'): ?> text-green-600 <?php else: ?> text-red-600 <?php endif; ?>"><?php echo e($item->outcome); ?></span>
                                    <?php if($item->win_amount > 0): ?>
                                        | <span class="text-gray-800">Win Sum:</span> <span class="text-green-700 font-bold"><?php echo e($item->win_amount); ?></span>
                                    <?php endif; ?>
                                </p>
                            </div>
                            <div class="text-sm text-gray-500 text-right">
                                <?php echo e(\Carbon\Carbon::parse($item->timestamp)->format('M d, Y - h:i A')); ?>

                                <span class="block text-xs">(<?php echo e(\Carbon\Carbon::parse($item->timestamp)->diffForHumans()); ?>)</span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
             <?php else: ?>
                <p class="text-center text-gray-500 py-8">No games played yet. Go back and play!</p>
             <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/history.blade.php ENDPATH**/ ?>