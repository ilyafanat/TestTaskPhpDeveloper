
<?php $__env->startSection('title', 'Welcome'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container mx-auto p-4 md:p-8 max-w-4xl">
        <div class="bg-white rounded-lg shadow-md p-8 mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-2 text-center">Access Granted!</h2>
            <p class="text-gray-600 text-lg text-center">
                Welcome, <span class="font-semibold text-blue-600"><?php echo e($user->username); ?></span>!
            </p>
            <p class="text-gray-500 mt-2 text-center text-sm">
                Your access is valid until:
                <span class="font-medium"><?php echo e($link->expires_at->format('F j, Y, g:i a')); ?></span>
            </p>

            <div class="mt-8 flex flex-col sm:flex-row justify-center items-center gap-4 border-t pt-6">
                <a href="<?php echo e(route('link.generate', ['token' => $link->token])); ?>" class="w-full sm:w-auto text-center bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md transition duration-150">
                    Generate New Link
                </a>
                <form action="<?php echo e(route('link.deactivate', ['token' => $link->token])); ?>" method="POST" class="w-full sm:w-auto">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md transition duration-150">
                        Deactivate Current Link
                    </button>
                </form>

                <a href="<?php echo e(route('game.history', ['token' => $link->token])); ?>" class="w-full sm:w-auto text-center bg-yellow-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md transition duration-150">
                    History
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-8 mb-8">
            <div class="text-center">
                <form action="<?php echo e(route('game.play', ['token' => $link->token])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-150">
                        Imfeelinglucky
                    </button>
                </form>
            </div>

            <?php if($gameResult): ?>
                <div class="mt-6 text-center p-4 rounded-lg
                    <?php if($gameResult['outcome'] === 'Win'): ?> bg-green-100 border-green-400 <?php else: ?> bg-red-100 border-red-400 <?php endif; ?>">
                    <p class="font-semibold text-xl">Your number: <span class="text-blue-600"><?php echo e($gameResult['number']); ?></span></p>
                    <p class="text-2xl font-bold
                        <?php if($gameResult['outcome'] === 'Win'): ?> text-green-700 <?php else: ?> text-red-700 <?php endif; ?>">
                        You <?php echo e($gameResult['outcome']); ?>!
                    </p>
                    <?php if($gameResult['outcome'] === 'Win' && $gameResult['win_amount'] > 0): ?>
                        <p class="text-lg text-green-800">Win Sum: <?php echo e($gameResult['win_amount']); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/protected_page.blade.php ENDPATH**/ ?>