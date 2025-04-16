@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<style>
/* Optional: Add some styling to visually hide the option */
option[style*="display:none"] {
  display: none;
}
#due_date {
    width: 150px; /* Adjust the width as needed */
    height: 30px; /* Adjust the height as needed */
}

.alert-modal {
  display: none;
  position: fixed;
  top: 10px;
  right: 10px;
  width: 300px;
  padding: 13px;
  background-color: #25b343!important;
  color: #fff;
  z-index: 9999;
  text-align: center;
  box-shadow: 1px 0px 10px rgba(1, 0, 0, 0.5);
}

.close-btn {
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 24px;
  font-weight: bold;
  cursor: pointer;
}

.show {
  display: block;
}
    .kanban-board {
      display: flex;
    }

    .kanban-column {
      flex: 1;
      margin: 10px;
      background-color: #f7f7f7;
      border-radius: 3px;
      box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .kanban-column-header-not-started {
      background-color: #ff3300;
      color: #ffffff;
      padding: 10px;
      font-weight: bold;
    }

    .kanban-column-header-in-progress {
      background-color: #4da6ff;
      color: #ffffff;
      padding: 10px;
      font-weight: bold;
    }

    .kanban-column-header-completed {
      background-color: #008000;
      color: #ffffff;
      padding: 10px;
      font-weight: bold;
    }

    .kanban-column-header-deferred {
      background-color: #264d73;
      color: #ffffff;
      padding: 10px;
      font-weight: bold;
    }


    .kanban-column-header-editor-approval {
      background-color: #7a7a52;
      color: #ffffff;
      padding: 10px;
      font-weight: bold;
    }

    .kanban-column-cards {
      min-height: 100px;
      padding: 10px;
    }

    .kanban-card {
      background-color: #fff;
      border-radius: 3px;
      box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.1);
      margin-bottom: 10px;
      padding: 10px;
    }

    .kanban-card-title {
      font-weight: bold;
      margin-bottom: 5px;
    }

    .kanban-card-description {
      color: #999;
      font-size: 14px;
    }
    .staff-profile-image-small {
    height: 32px;
    width: 32px;
    border-radius: 50%;
}
.custom-select {
  /* Add your custom styles here */
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 4px;
  width: 150px;
}

.custom-select option {
  /* Add your custom styles for options here */
  background-color: #f2f2f2;
  color: #333;
  padding: 5px;
}

.custom-select option:selected {
  /* Add your custom styles for the selected option here */
  background-color: #007bff;
  color: #fff;
}


</style>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card-body p-0">
            <div class="px-3 pt-3">
                <div class="card">
                    <div class="card-header">
                        <!-- Include Flash Messages -->
                        @include('admin.inc.message')
                    </div>
                    <div class="col-md-12">
                        <div class="ibox">
                            <div class="alert-modal" id="alert-modal">
                                <span class="close-btn" onclick="closeAlertModal()">&times;</span>
                                <p id="alert-message"></p>
                              </div>
                                <div class="ibox-content">
                                    <p class="col-12 mb-0 pt-2"><strong>ID: </strong>{{$rows[0]->journal_short_form}}-0000{{ $rows[0]->id }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Title: </strong>{{$rows[0]->title}}</p>
                                    <hr>
                                    <div class="card-header pb-0 px-2 bg-light border-bottom-0">
                                        <ul class="nav nav-tabs col-20" id="nav-tab">
                                            <li class="nav-item">
                                                <a data-toggle="tab" class="nav-link active" href="#details"><i class="fa fa-th"></i> Details</a>
                                            </li>
                                            <li class="nav-item">
                                                <a data-toggle="tab" class="nav-link" href="#tasks"><i class="fa fa-tasks"></i> Tasks</a>
                                            </li>
                                            <li class="nav-item">
                                                <a data-toggle="tab" class="nav-link" href="#files"><i class="fa fa-upload"></i> Files</a>
                                            </li>
                                            <li class="nav-item">
                                                <a data-toggle="tab" class="nav-link" href="#final_submission"><i class="fa fa-object-group" aria-hidden="true"></i> Final Submission</a>
                                            </li>
                                            <!-- <li class="nav-item">
                                                <a data-toggle="tab" class="nav-link" href="#communication"><i class="fa fa-comments" aria-hidden="true"></i> Communication</a>
                                            </li> -->
                                        </ul>
                                    </div>
                                    <div class="card-body p-2">

                                        <div class="tab-content">

                                            <div id="details" class="tab-pane ib-tab-box active">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12 my-2">
                                                                <p class="mb-0">
                                                                    <strong>Journal</strong>:
                                                                    <span class="label label-primary" style="color:#2196f3;">{{$rows[0]->journalname}}</span>
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4 col-xs-12" style="margin-bottom: 10px;">
                                                                <p class="mb-0">
                                                                    <strong>Status</strong> :
                                                                    <span class="badge badge-pill" style="background-color:{{$rows[0]->colourflag}}; color:#ffffff;border:1px solid {{$rows[0]->colourflag}}">{{$rows[0]->statusname}}</span>
                                                                    {{-- <span class="label label-success" id="inline_status" style="color:#2196f3">{{$rows[0]->statusname}}</span> --}}
                                                                </p>
                                                            </div>


                                                            <div class="col-md-4 col-xs-12" style="margin-bottom: 10px;">
                                                                <p class="mb-0">
                                                                    <strong>Mode of Processing</strong>:
                                                                    <span class="label label-primary" id='priority_status' style="color:#2196f3;">{{$rows[0]->processingname}}</span>
                                                                </p>
                                                            </div>

                                                            <div class="col-md-4 col-xs-12" style="margin-bottom: 10px;">
                                                                <p class="mb-0">
                                                                    <strong>Activation Status</strong>:
                                                                    @if( $rows[0]->status == 2 )
                                                                    <span class="badge badge-danger badge-pill">Inactive</span>
                                                                    @elseif( $rows[0]->status == 1 )
                                                                    <span class="badge badge-success badge-pill">Active</span>
                                                                    @endif
                                                                </p>
                                                            </div>


                                                            <div class="col-md-4 col-xs-12" style="margin-bottom: 10px;">
                                                                <p class="mb-0">
                                                                    <strong>Type of Article</strong>:
                                                                    <span class="label label-primary" id='ttype' style="color:#2196f3;">{{$rows[0]->articlename}}</span>
                                                                </p>
                                                            </div>

                                                            <div class="col-md-4 col-xs-12" style="margin-bottom: 10px;">
                                                                <p class="mb-0">
                                                                    <strong>Type of Issue</strong>:
                                                                    <span class="label label-primary" id='issue_type' style="color:#2196f3;">{{$rows[0]->issuename}}</span>
                                                                </p>
                                                            </div>

                                                            <div class="col-md-4 col-xs-12" style="margin-bottom: 10px;">
                                                                <p class="mb-0">
                                                                    <strong>Scheduled on</strong>:
                                                                    <span class="label label-primary" id='scheduled_on' style="">{{$rows[0]->scheduled_on}}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <hr>

                                                        <div class="mt-3">
                                                            <p class="mb-2"><strong>Received on: </strong>{{$rows[0]->created_at}}</p>
                                                            <p class="mb-2"><strong>Updated on: </strong>{{$rows[0]->updated_at}}</p>
                                                            {{-- <p class="mb-2"><strong>Revised on:</strong> </p> --}}
                                                            <p class="mb-2"><strong>Accepted on:</strong>
                                                            @if(isset($acceptances[0]->status))
                                                            @if($acceptances[0]->status == 'Accepted')
                                                                {{$acceptances[0]->accepted_on}}
                                                            @endif
                                                            @endif
                                                            </p>
                                                            <p class="mb-2"><strong>Published on: </strong>{{$rows[0]->scheduled_on}}</p>

                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 col-xs-12">
                                                                <label for="notes"><b>Notes:</b></label>
                                                                <div class="ml-4">
                                                                    {!! $rows[0]->notes !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                                
                                            <div id="tasks" class="tab-pane fade ib-tab-box">
                                                <div class="row">
                                                    <div class="col-md-8 col-sm-8">
                                                        <h4>All Tasks</h4>
                                                        <hr>
                                                        <div class="col-xl-8 col-lg-6">
                                                            <table class="table table-bordered table-hover sys_table">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">#</th>
                                                                        <th>Task Name</th>
                                                                        <th class="text-center">Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($tasks as $key => $task)
                                                                    <tr>
                                                                        <td class="text-center">{{$key + 1}}</td>
                                                                        <td>{{$task->task_name}}</td>
                                                                        <td class="text-center">
                                                                        @if ($task->status == 'Not Started')
                                                                                <span class="badge badge-pill" style="background-color:#ff3300; color:#ffffff;border:1px solid #ff704d">{{$task->status}}</span>
                                                                            @elseif ($task->status == 'In progress')
                                                                                <span class="badge badge-pill" style="background-color:#4da6ff; color:#ffffff;border:1px solid #99ccff">{{$task->status}}</span>
                                                                            @elseif ($task->status == 'Completed')
                                                                                <span class="badge badge-pill" style="background-color:#008000; color:#ffffff;border:1px solid #99ff33">{{$task->status}}</span>
                                                                            @elseif ($task->status == 'Deferred')
                                                                                <span class="badge badge-pill" style="background-color:#264d73; color:#ffffff;border:1px solid #336699">{{$task->status}}</span>
                                                                            @else
                                                                                <span class="badge badge-pill" style="background-color:#7a7a52; color:#ffffff;border:1px solid #a3a375">{{$task->status}}</span>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 col-sm-4">
                                                        <div style="float:right; margin-right:30px">
                                                            <h4>Task Overview</h4>
                                                            <p>1. Plagiarism Check</p>
                                                            <p>2. Peer-Review</p>
                                                            <p>3. Proofreading</p>
                                                            <p>4. Layout Editing</p>
                                                            <p>5. Galley Correction</p>
                                                            <p>6. Publishing</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="files" class="tab-pane fade ib-tab-box">


                                            <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="panel panel-default">
                                                                <div class="panel-body">
                                                                    <a data-toggle="modal" href="#modal_upload_file" class="btn btn-blue upload_file waves-effect waves-light" id="upload_file"><i class="fa fa-plus"></i> New File Upload</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
    
    
                                                    <div id="modal_upload_file" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form class="needs-validation" novalidate action="{{url('dashboard/staff/submission/author_file/'.$rows[0]->id)}}" method="post" enctype="multipart/form-data">
                                                                    @csrf
    
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title"><i class="fa fa-upload"></i> New File Upload</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="doc_title">Title</label>
                                                                                    <input type="text" class="form-control" id="doc_title" name="doc_title" required>
                                                                                </div>
                                                                            <hr>
                                                                            <label>Drop File Here</label>
                                                                            <input class="form-control" type="file" name="file" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
                                                                    <button type="submit" id="btn_add_file" class="btn btn-blue upload_file waves-effect waves-light">Submit</button>
                                                                </div>
                                                              </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <hr>
                                                            <div class="">
                                                                <table class="table table-bordered table-hover sys_table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center">#</th>
                                                                            <th width="60%">Title</th>
                                                                            <th>Created At</th>
                                                                            <th class="text-center">Manage</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td class="text-center">1</td>
                                                                        <td width="60%">{{$rows[0]->title}}</td>
                                                                        <td>{{$rows[0]->created_at}}</td>
                                                                        <td class="text-center">{{-- download article --}}
                                                                            @if(is_file('uploads/article/'.$rows[0]->file_path))
                                                                            <a href="{{ asset('uploads/article/'.$rows[0]->file_path) }}" download><button type="button" class="btn btn-sm btn-success"><i class="fa fa-download"></i>
                                                                            </button></a>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                        @php
                                                                            $i = 2;
                                                                        @endphp
                                                                        @foreach ($files_0 as $key => $file)
                                                                        <tr>

                                                                            <td class="text-center">{{$i}}</td>
                                                                            <td width="60%">{{$file->doc_title}}</td>
                                                                            <td>{{$file->create_at}}</td>
                                                                            <td class="text-center">{{-- download article --}}
                                                                                @if(is_file('uploads/article_file/'.$file->file_path))
                                                                                <a href="{{ asset('uploads/article_file/'.$file->file_path) }}" download><button type="button" class="btn btn-sm btn-success"><i class="fa fa-download"></i></button></a>
                                                                                {{-- <a href="{{ asset('uploads/article_file/'.$file->file_path) }}"><button type="button" class="btn btn-sm btn-danger"></i></button></a> --}}
                                                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $file->id }}">
                                                                                    <i class="fas fa-trash-alt"></i>
                                                                                </button>
                                                                                @include('admin.file.delete')
                                                                                @endif
                                                                            </td>
                                                                            @php
                                                                            $i += 1;
                                                                            @endphp
                                                                        </tr>

                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <!-- ------------------- -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                            <h4>Plagiarism report :</h4>
                                                                <a data-toggle="modal" href="#plagiarism_report" class="btn btn-blue upload_file waves-effect waves-light" id="upload_file"><i class="fa fa-plus"></i> New File Upload</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                  

                                                <div id="plagiarism_report" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form class="needs-validation" novalidate action="{{url('dashboard/staff/submission/plagiarism_report/'.$rows[0]->id)}}" method="post" enctype="multipart/form-data">
                                                                @csrf

                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><i class="fa fa-upload"></i> Plagiarism Report Upload</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="doc_title">Title</label>
                                                                                <input type="text" class="form-control" id="doc_title" name="doc_title" required>
                                                                            </div>
                                                                        <hr>
                                                                        <label>Drop File Here</label>
                                                                        <input class="form-control" type="file" name="file" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
                                                                <button type="submit" id="btn_add_file" class="btn btn-blue upload_file waves-effect waves-light">Submit</button>
                                                            </div>
                                                          </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <hr>
                                                        <div class="">
                                                            <table class="table table-bordered table-hover sys_table">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">#</th>
                                                                        <th width="60%">Title</th>
                                                                        <th>Created At</th>
                                                                        <th class="text-center">Manage</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    @foreach ($files_1 as $key => $file)
                                                                    <tr>
                                                                        <td class="text-center">{{$key + 2}}</td>
                                                                        <td width="60%">{{$file->doc_title}}</td>
                                                                        <td>{{$file->create_at}}</td>
                                                                        <td class="text-center">{{-- download article --}}
                                                                            @if(is_file('uploads/article_file/'.$file->file_path))
                                                                            <a href="{{ asset('uploads/article_file/'.$file->file_path) }}" download><button type="button" class="btn btn-sm btn-success"><i class="fa fa-download"></i></button></a>
                                                                            {{-- <a href="{{ asset('uploads/article_file/'.$file->file_path) }}"><button type="button" class="btn btn-sm btn-danger"></i></button></a> --}}
                                                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $file->id }}">
                                                                                <i class="fas fa-trash-alt"></i>
                                                                            </button>
                                                                            @include('admin.file.delete')
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 2 report -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                            <h4>Certificate Details :</h4>
                                                                <a data-toggle="modal" href="#certificate_details" class="btn btn-blue upload_file waves-effect waves-light" id="upload_file"><i class="fa fa-plus"></i> New File Upload</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="certificate_details" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form class="needs-validation" novalidate action="{{url('dashboard/staff/submission/certificate_details/'.$rows[0]->id)}}" method="post" enctype="multipart/form-data">
                                                                @csrf

                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><i class="fa fa-upload"></i> Certificate Details Upload</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="doc_title">Title</label>
                                                                                <input type="text" class="form-control" id="doc_title" name="doc_title" required>
                                                                            </div>
                                                                        <hr>
                                                                        <label>Drop File Here</label>
                                                                        <input class="form-control" type="file" name="file" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
                                                                <button type="submit" id="btn_add_file" class="btn btn-blue upload_file waves-effect waves-light">Submit</button>
                                                            </div>
                                                          </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <hr>
                                                        <div class="">
                                                            <table class="table table-bordered table-hover sys_table">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">#</th>
                                                                        <th width="60%">Title</th>
                                                                        <th>Created At</th>
                                                                        <th class="text-center">Manage</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                
                                                                    @foreach ($files_2 as $key => $file)
                                                                    <tr>
                                                                        <td class="text-center">{{$key + 2}}</td>
                                                                        <td width="60%">{{$file->doc_title}}</td>
                                                                        <td>{{$file->create_at}}</td>
                                                                        <td class="text-center">{{-- download article --}}
                                                                            @if(is_file('uploads/article_file/'.$file->file_path))
                                                                            <a href="{{ asset('uploads/article_file/'.$file->file_path) }}" download><button type="button" class="btn btn-sm btn-success"><i class="fa fa-download"></i></button></a>
                                                                            {{-- <a href="{{ asset('uploads/article_file/'.$file->file_path) }}"><button type="button" class="btn btn-sm btn-danger"></i></button></a> --}}
                                                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $file->id }}">
                                                                                <i class="fas fa-trash-alt"></i>
                                                                            </button>
                                                                            @include('admin.file.delete')
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- 3rd  -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                            <h4>Published article details :</h4>
                                                                <a data-toggle="modal" href="#published_article_details" class="btn btn-blue upload_file waves-effect waves-light" id="upload_file"><i class="fa fa-plus"></i> New File Upload</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="published_article_details" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form class="needs-validation" novalidate action="{{url('dashboard/staff/submission/published_article_details/'.$rows[0]->id)}}" method="post" enctype="multipart/form-data">
                                                                @csrf

                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><i class="fa fa-upload"></i> Certificate Details Upload</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="doc_title">Title</label>
                                                                                <input type="text" class="form-control" id="doc_title" name="doc_title" required>
                                                                            </div>
                                                                        <hr>
                                                                        <label>Drop File Here</label>
                                                                        <input class="form-control" type="file" name="file" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
                                                                <button type="submit" id="btn_add_file" class="btn btn-blue upload_file waves-effect waves-light">Submit</button>
                                                            </div>
                                                          </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <hr>
                                                        <div class="">
                                                            <table class="table table-bordered table-hover sys_table">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">#</th>
                                                                        <th width="60%">Title</th>
                                                                        <th>Created At</th>
                                                                        <th class="text-center">Manage</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    
                                                                    @foreach ($files_3 as $key => $file)
                                                                    <tr>
                                                                        <td class="text-center">{{$key + 2}}</td>
                                                                        <td width="60%">{{$file->doc_title}}</td>
                                                                        <td>{{$file->create_at}}</td>
                                                                        <td class="text-center">{{-- download article --}}
                                                                            @if(is_file('uploads/article_file/'.$file->file_path))
                                                                            <a href="{{ asset('uploads/article_file/'.$file->file_path) }}" download><button type="button" class="btn btn-sm btn-success"><i class="fa fa-download"></i></button></a>
                                                                            {{-- <a href="{{ asset('uploads/article_file/'.$file->file_path) }}"><button type="button" class="btn btn-sm btn-danger"></i></button></a> --}}
                                                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $file->id }}">
                                                                                <i class="fas fa-trash-alt"></i>
                                                                            </button>
                                                                            @include('admin.file.delete')
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                            

                                            <div id="final_submission" class="tab-pane fade ib-tab-box">
                                               
                                                <hr>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                                <h4>Final Manuscript: </h4>
                                                                <a data-toggle="modal" href="#final_manuscript" class="btn btn-blue upload_file waves-effect waves-light" id="upload_file"><i class="fa fa-plus"></i> New File Upload</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="final_manuscript" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form class="needs-validation" novalidate action="{{url('dashboard/admin/submission/final_submission_manuscript/'.$rows[0]->id)}}" method="post" enctype="multipart/form-data">
                                                                @csrf

                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><i class="fa fa-upload"></i> Manuscript Upload</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label>Drop File Here</label>
                                                                        <input class="form-control" type="file" name="file" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
                                                                <button type="submit" id="btn_add_file" class="btn btn-blue upload_file waves-effect waves-light">Submit</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <hr>
                                                        <div class="">
                                                            <table class="table table-bordered table-hover sys_table">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">#</th>
                                                                        <th width="65%">Title</th>
                                                                        <th>Created At</th>
                                                                        <th class="text-center" style="width:125px;">Manage</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($final_manuscripts as $key => $row)
                                                                    <tr>
                                                                        <td class="text-center">{{$key + 1}}</td>
                                                                        <td width="65%">{{$row->doc_title}}</td>
                                                                        <td>{{$row->create_at}}</td>
                                                                        <td class="text-center" style="width:125px;">
                                                                            {{-- download copyrigth form --}}
                                                                            @if(is_file('uploads/final_submission/'.$row->file_path))
                                                                            <a href="{{ asset('uploads/final_submission/'.$row->file_path) }}" download><button type="button" class="btn btn-sm btn-success"><i class="fa fa-download"></i>
                                                                            </button></a>
                                                                            @endif
                                                                            @if ($row->freeze_data == 0)
                                                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal-{{ $row->id }}">
                                                                                <i class="far fa-edit"></i>
                                                                            </button>
                                                                            @include('author.files_edit.final_submission_manuscript')
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>


                                                
                                          
                                                

                                                
                                                <div class="row">
                                                    <div class="col-md-12" align="center">
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                                {{-- <h4>After </h4> --}}
                                                                <a href="#" class="btn btn-blue upload_file waves-effect waves-light"> Final Submit</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jkanban@1.3.1/dist/jkanban.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    var kanbanBoards = document.querySelectorAll('.kanban-column-cards');
    kanbanBoards.forEach(function(kanbanBoard) {
    new Sortable(kanbanBoard, {
    group: 'kanban-column',
    animation: 150,
    onEnd: (event) => {
                const cardElement = event.item;
                const cardId = cardElement.getAttribute('data-card-id');
                const fromColumnId = cardElement.parentNode.parentNode.getAttribute('data-column-name');
                // const toColumnId = cardElement.parentNode.parentNode.getAttribute('data-column-id');
                // const position = [...cardElement.parentNode.children].indexOf(cardElement);
                // alert(cardId)
                // alert(fromColumnId);


                if (cardId == null){
                    const cardId_1 = cardElement.getAttribute('data-id');
                    const fromColumnId_1 = cardElement.parentNode.parentNode.getAttribute('status-name');
                    // alert(cardId_1);
                    // alert(fromColumnId_1);

                    $.ajax({
                    method: 'POST',
                    url: '{{URL::to('/dashboard/admin/submission/kan-ban-review')}}',
                    data:{ _token: "{{csrf_token()}}", id: cardId_1, status: fromColumnId_1 },
                    success:function(data){
                        showAlertModal(data);
                        afterRefreshthenpassthepostdata('review');

                    },
                    error:function(){
                        alert("Something went Wrong!!!");
                    }
                    })


                }else{
                    // alert(cardId)
                    // alert(fromColumnId);
                    $.ajax({
                    method: 'POST',
                    url: '{{URL::to('/dashboard/admin/submission/kan-ban-task')}}',
                    data:{ _token: "{{csrf_token()}}", id: cardId, status: fromColumnId },
                    success:function(data){
                        showAlertModal(data);
                        afterRefreshthenpassthepostdata('tasks');
                    },
                    error:function(){
                        alert("Something went Wrong!!!");
                    }
                    })
                }
        },
    });
});

// Function to simulate a successful AJAX request
function afterRefreshthenpassthepostdata(tabshow) {
    // Simulate a successful AJAX request and get the data
    const postData = tabshow; // Replace with the actual data received from the server

    // Store the POST data in localStorage
    localStorage.setItem('postData', postData);

    // Refresh the page after the data is saved
    window.location.reload();
}

function afterrefreshshowthetab() {
    const tabToShow = localStorage.getItem('postData');

    if (tabToShow == 'tasks') {
        $('#nav-tab a[href="#tasks"]').tab('show');
    } else if (tabToShow == 'review') {
        $('#nav-tab a[href="#review"]').tab('show');
    } else if (tabToShow == 'payments') {
        $('#nav-tab a[href="#payments"]').tab('show');
    }
    localStorage.removeItem('postData');

}

window.onload = function() {
    afterrefreshshowthetab();
};


//Details data change Asynchronous
$('#journal_type').change(function(){
    let val=$(this).val();
    var id_value=<?php echo $id ?>;
            // alert(list);
            // alert(val);
    $.ajax({
    method: 'POST',
    url: '{{URL::to('/dashboard/admin/submission/journal_ajax')}}',
    data:{ _token: "{{csrf_token()}}", journaldata: val, id: id_value },
    success:function(data){
        refreshPage()
        // setInterval(5000);
        showAlertModal(data);
        // sweet_alert(data, "success");
        // $("#message").empty();
        // $("#message").append('<div class="alert alert-info">'+data+'</div>');
    },
    error:function(){
        sweet_alert("Something went Wrong!!!", "error");
    }
    })
});

$('#article_type').change(function(){
    let val=$(this).val();
    var id_value=<?php echo $id ?>;
    $.ajax({
    method: 'POST',
    url: '{{URL::to('/dashboard/admin/submission/journal_ajax')}}',
    data:{ _token: "{{csrf_token()}}", articledata: val, id: id_value },
    success:function(data){
        refreshPage()
        showAlertModal(data);
    },
    error:function(){
        sweet_alert("Something went Wrong!!!", "error");
    }
    })
});

$('#issue_type').change(function(){
    let val=$(this).val();
    var id_value=<?php echo $id ?>;
    $.ajax({
    method: 'POST',
    url: '{{URL::to('/dashboard/admin/submission/journal_ajax')}}',
    data:{ _token: "{{csrf_token()}}", issuedata: val, id: id_value },
    success:function(data){
        // sweet_alert(data, "success");
        refreshPage()
        showAlertModal(data);
    },
    error:function(){
        sweet_alert("Something went Wrong!!!", "error");
    }
    })
});


$('#processing_type').change(function(){
    let val=$(this).val();
    var id_value=<?php echo $id ?>;
    $.ajax({
    method: 'POST',
    url: '{{URL::to('/dashboard/admin/submission/journal_ajax')}}',
    data:{ _token: "{{csrf_token()}}", processingdata: val, id: id_value },
    success:function(data){
        // sweet_alert(data, "success");
        refreshPage()
        showAlertModal(data);
    },
    error:function(){
        sweet_alert("Something went Wrong!!!", "error");
    }
    })
});

$('#status_type').change(function(){
    let val=$(this).val();
    var id_value=<?php echo $id ?>;
    $.ajax({
    method: 'POST',
    url: '{{URL::to('/dashboard/admin/submission/journal_ajax')}}',
    data:{ _token: "{{csrf_token()}}", statusdata: val, id: id_value },
    success:function(data){
        // sweet_alert(data, "success");
        refreshPage()
        showAlertModal(data);
    },
    error:function(){
        sweet_alert("Something went Wrong!!!", "error");
    }
    })
});

$('#activation_status').change(function(){
    let val=$(this).val();
    var id_value=<?php echo $id ?>;
    $.ajax({
    method: 'POST',
    url: '{{URL::to('/dashboard/admin/submission/journal_ajax')}}',
    data:{ _token: "{{csrf_token()}}", activation_statusdata: val, id: id_value },
    success:function(data){
                //
        // sweet_alert(data, "success");
        refreshPage()
        showAlertModal(data);
    },
    error:function(){
        sweet_alert("Something went Wrong!!!", "error");
    }
    })
});

$('#scheduled_on').on('blur', function(){
    let val=$(this).val();
    var id_value=<?php echo $id ?>;
    $.ajax({
    method: 'POST',
    url: '{{URL::to('/dashboard/admin/submission/journal_ajax')}}',
    data:{ _token: "{{csrf_token()}}", sheduled_ondata: val, id: id_value },
    success:function(data){
                //
        // sweet_alert(data, "success");
        refreshPage()
        showAlertModal(data);
    },
    error:function(){
        sweet_alert("Something went Wrong!!!", "error");
    }
    })
});


// $('#accept_save').on('click', function(){
//     var id_value=<?php echo $id ?>;
//     $.ajax({
//     method: 'POST',
//     url: '{{URL::to('/dashboard/admin/submission/copyright_form')}}',
//     data:{ _token: "{{csrf_token()}}", id: id_value },
//     success: function(response) {
//         // Create a download link for the PDF
//         var link = document.createElement('a');
//         link.href = URL.createObjectURL(new Blob([response]));
//         link.download = 'file.pdf';
//         link.click();
//     },
//     error: function(xhr, status, error) {
//         console.log(error);
//     }
//     })
// });


function sweet_alert(data, message)
{
    Swal.fire({
        position: 'top-end',
        icon: message,
        title: data,
        showConfirmButton: false,
        timer: 2000
    })
}

// $(".form-control option").each(function() {
//   $(this).siblings('[value="'+ this.value +'"]').remove();
// })

function showAlertModal(message) {
  // Set the alert message text
  document.getElementById("alert-message").innerHTML = message;

  // Show the alert modal
  var modal = document.getElementById("alert-modal");
  modal.classList.add("show");

  // Hide the alert modal after 3 seconds
  setTimeout(function() {
    modal.classList.remove("show");
  }, 3000);
}

function closeAlertModal() {
  // Hide the alert modal
  var modal = document.getElementById("alert-modal");
  modal.classList.remove("show");
}

function refreshPage() {
    location.reload(true);
}

function hideselectoptiontag()
{

// Get the select element
// const selectElement = document.getElementById("journal_type");

const selectElement = document.getElementById("status_type");

// const selectElement = document.getElementById("status_type");

// const selectElement = document.getElementById("status_type");

// const selectElement = document.getElementById("status_type");

// const selectElement = document.getElementById("status_type");

// const selectElement = document.getElementById("status_type");

// Get the selected option
const selectedOption = selectElement.options[selectElement.selectedIndex];

// Hide the selected option
selectedOption.style.display = "none";

}

hideselectoptiontag();
$(document).ready(function () {
  $('#nav-tab a[href="#{{ old('tab') }}"]').tab('show')
});


$('#review_decision').change(function(){
    let val=$(this).val();
    // alert(val);
    var id_value=<?php echo $id ?>;
    $.ajax({
    method: 'POST',
    url: '{{URL::to('/dashboard/admin/submission/review_decision')}}',
    data:{ _token: "{{csrf_token()}}", status: val, id:id_value },
    success:function(data){
                //
        // sweet_alert(data, "success");
        // refreshPage()
        showAlertModal(data);
    },
    error:function(){
        sweet_alert("Something went Wrong!!!", "error");
    }
    })
});


$('#acceptance_status').change(function(){
    let val=$(this).val();
    // alert(val);
    var id_value=<?php echo $id ?>;
    $.ajax({
    method: 'POST',
    url: '{{URL::to('/dashboard/admin/submission/acceptance_status')}}',
    data:{ _token: "{{csrf_token()}}", status: val, id:id_value },
    success:function(data){
                //
        // sweet_alert(data, "success");
        // refreshPage()
        showAlertModal(data);
        refreshPage()
    },
    error:function(){
        sweet_alert("Something went Wrong!!!", "error");
    }
    })
});

$('#payment_status_1').change(function(){
    let val=$(this).val();
    // alert(val);
    var id_value=<?php echo $id ?>;
    $.ajax({
    method: 'POST',
    url: '{{URL::to('/dashboard/admin/submission/payment_status')}}',
    data:{ _token: "{{csrf_token()}}", status: val, id:id_value },
    success:function(data){
        if (data === '') {
                alert('Please Valid option');
                return; // Stop execution
            }
        showAlertModal(data);
        afterRefreshthenpassthepostdata('payments');
    },
    error:function(){
        sweet_alert("Something went Wrong!!!", "error");
    }
    })
});

$('#payment_status_2').change(function(){
    let val=$(this).val();
    // alert(val);
    var id_value=<?php echo $id ?>;
    $.ajax({
    method: 'POST',
    url: '{{URL::to('/dashboard/admin/submission/payment_status')}}',
    data:{ _token: "{{csrf_token()}}", status: val, id:id_value },
    success:function(data){
        if (data === '') {
                alert('Please Valid option');
                return; // Stop execution
            }
        showAlertModal(data);
        afterRefreshthenpassthepostdata('payments');
    },
    error:function(){
        // sweet_alert("Something went Wrong!!!", "error");
    }
    })
});

$('#payment_status_3').change(function(){
    let val=$(this).val();
    // alert(val);
    var id_value=<?php echo $id ?>;
    $.ajax({
    method: 'POST',
    url: '{{URL::to('/dashboard/admin/submission/payment_status')}}',
    data:{ _token: "{{csrf_token()}}", status: val, id:id_value },
    success:function(data){
        if (data === '') {
                alert('Please Enter Valid option');
                return; // Stop execution
            }
        showAlertModal(data);
        afterRefreshthenpassthepostdata('payments');
    },
    error:function(){
        // sweet_alert("Something went Wrong!!!", "error");
    }
    })
});
</script>
@endsection
