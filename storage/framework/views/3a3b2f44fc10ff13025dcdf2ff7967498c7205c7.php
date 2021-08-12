<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .help-block {
            color: red;
            }

        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if(session()->has('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session()->get('success')); ?>

                    </div>
                    <?php endif; ?>
                    <div class="row" style="margin:100px">
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-info btn-lg pull-left" data-toggle="modal" data-target="#add-form">Import</button>                  
                        </div>
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#view-form">View</button>                  
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>  
                                <th>Sr No.</th>
                                <th>Category</th>
                                <th>Product</th>
                                <th>Product Code</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($details)): ?>
                            <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key+1); ?></td>
                                    <td><?php echo e($item['category']['ct_title']); ?></td>
                                    <td><?php echo e($item['title']); ?></td>
                                    <td><?php echo e($item['code']); ?></td>
                                    <td><?php echo e($item['description']); ?></td>
                                    <td><?php echo e($item['price']); ?></td>
                                    <td><?php echo e($item['quantity']); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr><td colspan="6"><span class="text-danger">No Data Available!!! Please Upload a File</span><td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="add-form" class="modal fade" role="dialog">
            <div class="modal-dialog">       
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Import</h4>
                    </div>
                    <div class="modal-body">
                        <form class="dform" method="post" action="<?php echo e(route('import')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row" style="margin:10px">
                                <div class="col-md-6">
                                    <label for="file">Upload Excel:</label>
                                    <input type="file" name="file" class="form-control" id="file" value="<?php echo e(old('file')); ?>">
                                </div>
                            </div>  
                            <div class="row"style="margin:10px">
                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            </div>                      
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!--modal of view excel wise -->
        <div id="view-form" class="modal fade" role="dialog">
            <div class="modal-dialog">       
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Field Wise Data</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>  
                                    <th>System Field.</th>
                                    <th>Excel/CSV Import Fields</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($fields)): ?>
                                    <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fname=>$field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-capitalize"><?php echo e($fname); ?></td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="sel1">Select Field:</label>
                                                    <select class="form-control" id="sel1">
                                                        <option>Select</option>
                                                        <?php $__currentLoopData = $field; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option><?php echo e($value); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html><?php /**PATH /var/www/html/projects/ImportExcel/resources/views/index.blade.php ENDPATH**/ ?>