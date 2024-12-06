<?php $__env->startSection('content'); ?>
<div>
    <div class="text-center font-semibold space-y-5 mb-3">
        <h3>Send File</h3>
    </div>
    <div class="font-semibold text-right">
        <a href="<?php echo e(route('teamleader.mydepartment')); ?>">
            <button type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Back
            </button>
        </a>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <form action="<?php echo e(route('department.savecontent')); ?>" method="POST" enctype="multipart/form-data"
            class="max-w-sm mx-auto mb-8">
            <?php echo csrf_field(); ?>

            <div class="mb-5">
                <label for="topic" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">File Topic</label>

                <?php if(isset($topics)): ?>
                <select name="topic" id="topic-select"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
                    <option value="">Select Topic</option>
                    <option value="new-topic">New Topic</option>
                    
                </select>

                <input type="text" id="topic-input" name="topic" style="display:none;"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="New File Topic" />
                <?php else: ?>
                <input type="text" id="topic" name="topic"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="New File Topic" />
                <?php endif; ?>
            </div>
            <div class="mb-5">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">File
                    Title</label>
                <input type="text" id="title" name="title"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="File Title" required />
            </div>
            <div class="mb-5">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">File
                    Description</label>
                <textarea id="description" name="description"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="File Description" required></textarea>
            </div>
            <div class="mb-5">
                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload
                    File Type</label>
                <select name="" id="type" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
                    <option value="">Select File Type</option>
                    <option value="video">Video</option>
                    <option value="document">Document</option>
                    <option value="link">Link</option>
                </select>
            </div>
            <div class="mb-5" id="videodiv" hidden>
                <label for="video" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload
                    Video</label>
                <input type="file" id="video" name="video"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    accept="video/*" />
            </div>
            <div class="mb-5" id="docdiv" hidden>
                <label for="document" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload
                    Document</label>
                <input type="file" id="document" name="document"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.ppt,.pptx,.odt,.ods,.odp,.rtf,.html,.htm,.md,.csv" />
            </div>
            <div class="mb-5" id="link" hidden>
                <label for="link" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">External
                    Link</label>
                <input type="url" id="link" name="external_link"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="External Link" />
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Upload file</button>
        </form>
    </div>
</div>

<script src="<?php echo e(asset('scripts/teamleaderScripts.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.teamleader.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\leti\Desktop\PRMS - Copy\resources\views/teamleader/departmentcontentform.blade.php ENDPATH**/ ?>