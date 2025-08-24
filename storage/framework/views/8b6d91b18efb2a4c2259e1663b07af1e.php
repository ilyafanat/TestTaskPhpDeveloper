
<?php $__env->startSection('title', 'Access Link Generated'); ?>
<?php $__env->startSection('content'); ?>
    <div class="w-full max-w-2xl bg-white rounded-lg shadow-md p-8 text-center">
        <svg class="mx-auto h-12 w-12 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <p class="text-gray-600 mb-6">Here is your unique access link. It is valid for 7 days.</p>

        <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
            <p class="text-blue-600 break-words" id="accessLink"><?php echo e($link); ?></p>
        </div>
        
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/link_generated.blade.php ENDPATH**/ ?>