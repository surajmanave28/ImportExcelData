<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif
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
                            @if (count($details))
                            @foreach ($details as $key=>$item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item['category']['ct_title']}}</td>
                                    <td>{{$item['title']}}</td>
                                    <td>{{$item['code']}}</td>
                                    <td>{{$item['description']}}</td>
                                    <td>{{$item['price']}}</td>
                                    <td>{{$item['quantity']}}</td>
                                </tr>
                            @endforeach
                            @else
                                <tr><td colspan="6"><span class="text-danger">No Data Available!!! Please Upload a File</span><td></tr>
                            @endif
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
                        <form class="dform" method="post" action="{{route('import')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row" style="margin:10px">
                                <div class="col-md-6">
                                    <label for="file">Upload Excel:</label>
                                    <input type="file" name="file" class="form-control" id="file" value="{{ old('file') }}">
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
                                @if (count($fields))
                                    @foreach ($fields as $fname=>$field)
                                        <tr>
                                            <td class="text-capitalize">{{$fname}}</td>
                                            <td>
                                                <div class="form-group">
                                                    <label for="sel1">Select Field:</label>
                                                    <select class="form-control" id="sel1">
                                                        <option>Select</option>
                                                        @foreach ($field as $value)
                                                        <option>{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>