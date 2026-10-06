@extends('admin.layout')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 663.135px;">
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add New Member

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create New</h3>
                        <div class="box-tools pull-right">
                            <a href="acount_list" class="btn btn-success btn-sm" title="Add New">
                                <i class="fa fa-angle-double-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <form action="transaction_store" method="post" id="form" enctype="multipart/form-data" novalidate="novalidate">
                    {{csrf_field()}}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" name="date" class="form-control" id="date" required>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="number" step="0.01" name="amount" class="form-control" id="amount" required>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="from">Transfer From</label>
                                        <select name="from" id="from" class="form-control" required>
                                        <option value="1 ">1 </option>    
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="attachment">Attachment</label>
                                        <input type="file" name="attachment" id="attachment" style=""><div class="bootstrap-filestyle input-group"></div>
                                        <span class="help-block">Max size 500KB | expected resolution 500px X 500px | JPG/JPEG file only</span>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" rows="2" class="form-control"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-flat">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    

  
  @endsection
  