@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div>
            <!-- Page Heading Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Solution Profile
                    @can('ADD SOLUTION PROFILE')
                        <a href="{{url('solutionprofile/create')}}?searchvalue={{((isset($input['searchvalue']))?$input['searchvalue']:'')}}&page={{((isset($input['page']))?$input['page']:'')}}&tab={{$tab}}" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i> Create
                        </a>
                    @endcan
                </h1>
            </div>
            <!-- Page Heading End -->

            <!-- Tab Start -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4" id="myTab">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" id="solutionprofile-tab" data-toggle="tab" href="#solutionprofile1">Solution Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="solutionpending-tab" data-toggle="tab" href="#solutionpending1">Pending</a>
                    </li>
                </ul>
            </div>
            <!-- Tab End -->

            <div class="tab-content">
                <div id="solutionprofile" class="tab-pane">

                    @include('partials/messages')

                    <div class="d-flex">
                        {{ $solutionprofile->appends($params)->links("pagination::bootstrap-4") }}
                        @if($solutionprofile->hasMorepages() || (isset($input['searchvalue']) && $input["searchvalue"]!=""))
                            <form action="{{action('App\Http\Controllers\SolutionProfilesController@index')}}">
                                <div class="col-12">
                                    <input class="form-control" placeholder="Search" name="searchvalue" value="{{((isset($input['searchvalue']))?$input['searchvalue']:'')}}">
                                </div>
                            </form>
                        @endif
                    </div>

                    <table class="table table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th style="width: 2%">#</th>
                            <th style="width: 7%">Solution Code</th>
                            <th style="width: 28%">Description</th>
                            <th style="width: 48%">Solution</th>
                            <th style="width: 3%">Active</th>
                            <th style="width: 10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($solutionprofile) && $solutionprofile->count()>0)
                            @foreach ($solutionprofile as $irow=> $rsolutionprofile)
                                <tr>
                                    <th scope="row">{{ $irow+1 }}</th>
                                    <td >{{$rsolutionprofile->solutioncode}}</td>
                                    <td style="word-break: break-all;">{!!$rsolutionprofile->problem_description!!}</td>
                                    <td  style="word-break: break-all;">{!!$rsolutionprofile->problem_solution!!}</td>
                                    <td >{{(($rsolutionprofile->active=="1")?"Yes":"No")}}</td>
                                    <td class="text-center col-2">
                                        <div class="d-flex">
                                            @can('VIEW SOLUTION PROFILE')
                                                <a href="{{action('App\Http\Controllers\SolutionProfilesController@show',$rsolutionprofile->id)}}?searchvalue={{((isset($input['searchvalue']))?$input['searchvalue']:'')}}&page={{((isset($input['page']))?$input['page']:'')}}&tab={{((isset($input['tab']))?$input['tab']:'solutionprofile-tab')}}"  class="btn btn-primary ">View</a>&nbsp;
                                            @endcan

                                            @can('EDIT SOLUTION PROFILE')
                                                <a href="{{action('App\Http\Controllers\SolutionProfilesController@edit',$rsolutionprofile->id)}}?searchvalue={{((isset($input['searchvalue']))?$input['searchvalue']:'')}}&page={{((isset($input['page']))?$input['page']:'')}}&tab={{((isset($input['tab']))?$input['tab']:'solutionprofile-tab')}}"  class="btn btn-primary ">Edit</a>&nbsp;
                                            @endcan

                                            @can('DELETE SOLUTION PROFILE')
                                                <form action="{{action('App\Http\Controllers\SolutionProfilesController@destroy', $rsolutionprofile->id)}}?searchvalue={{((isset($input['searchvalue']))?$input['searchvalue']:'')}}&page={{((isset($input['page']))?$input['page']:'')}}&tab={{((isset($input['tab']))?$input['tab']:'solutionprofile-tab')}}" method="post" id="deleteForm_{{ $rsolutionprofile->id }}">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger" type="submit" onclick="showConfirmDeleteModal(event, {{ $rsolutionprofile->id }})">Delete</button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="6">No Record Found</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    {{ $solutionprofile->appends($params)->links("pagination::bootstrap-4") }}
                </div>

                <div id="solutionpending" class="tab-pane fade">

                    @include('partials/messages')

                    <div class="d-flex col-12">
                        {{ $solutionpending->appends($params)->links("pagination::bootstrap-4") }}
                        @if($solutionpending->hasMorepages() || (isset($input['searchvalue']) && $input["searchvalue"]!=""))
                            <form action="{{action('App\Http\Controllers\SolutionProfilesController@index')}}">
                                <div class="col-12">
                                    <input class="form-control" placeholder="Search" name="searchvalue" value="{{((isset($input['searchvalue']))?$input['searchvalue']:'')}}">
                                </div>
                            </form>
                        @endif
                        <div class="row pull-right"  id="show_btn" style=" width:100px; right:0;position:absolute;">
                            <div class="col-12" >
                                <button id="deletebtn" class="btn btn-danger" style="right: 10px" type="button">Delete</button>
                            </div>
                        </div>
                    </div>

                    <form id="delete_multi" action="{{action('App\Http\Controllers\SolutionProfilesController@destroy',0)}}?searchvalue={{((isset($input['searchvalue']))?$input['searchvalue']:'')}}&page={{((isset($input['page']))?$input['page']:'')}}&tab={{((isset($input['tab']))?$input['tab']:'solutionpending-tab')}}" method="post">
                        <table class="table table-striped">
                            <thead class="thead-light">
                            <tr>
                                <th style="width: 2%"><input type="checkbox" id="chk_all" name="chk_all" value="All"></th>
                                <th style="width: 7%">Solution Code</th>
                                <th style="width: 28%">Description</th>
                                <th style="width: 48%">Solution</th>
                                <th style="width: 3%">Active</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($solutionpending) && $solutionpending->count()>0)
                                @foreach ($solutionpending as $irows=> $rsolutionpending)
                                    <tr>
                                        <th scope="row">
                                            @csrf
                                            @method('DELETE')

                                            <input type="checkbox" class="chkbox" data-id="{{$rsolutionpending->id}}" id="chkbox_{{$rsolutionpending->id}}" name="solutionselect[{{$rsolutionpending->id}}]">
                                        </th>

                                        <td >{{$rsolutionpending->solutioncode}}</td>
                                        <td style="word-break: break-all;">{!!$rsolutionpending->problem_description!!}</td>
                                        <td  style="word-break: break-all;">{!!$rsolutionpending->problem_solution!!}</td>
                                        <td >Pending</td>
                                        <td class="text-center col-2">
                                            <div class="d-flex">
                                                @can('VIEW SOLUTION PROFILE')
                                                    <a href="{{action('App\Http\Controllers\SolutionProfilesController@show',$rsolutionpending->id)}}?searchvalue={{((isset($input['searchvalue']))?$input['searchvalue']:'')}}&page={{((isset($input['page']))?$input['page']:'')}}&tab={{((isset($input['tab']))?$input['tab']:'solutionpending-tab')}}"  class="btn btn-primary ">View</a>&nbsp;
                                                @endcan

                                                @can('EDIT SOLUTION PROFILE')
                                                    <a href="{{action('App\Http\Controllers\SolutionProfilesController@edit',$rsolutionpending->id)}}?searchvalue={{((isset($input['searchvalue']))?$input['searchvalue']:'')}}&page={{((isset($input['page']))?$input['page']:'')}}&tab={{((isset($input['tab']))?$input['tab']:'solutionpending-tab')}}"  class="btn btn-primary ">Edit</a>&nbsp;
                                                @endcan

                                                @can('DELETE SOLUTION PROFILE')
                                                    <!--
                                                    <form action="{{action('App\Http\Controllers\SolutionProfilesController@show', $rsolutionpending->id)}}?searchvalue={{((isset($input['searchvalue']))?$input['searchvalue']:'')}}&page={{((isset($input['page']))?$input['page']:'')}}&tab={{((isset($input['tab']))?$input['tab']:'solutionpending-tab')}}" method="post">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button class="btn btn-danger deletesolutionbtn" data-id="{{$rsolutionpending->id}}" type="button">Delete</button>
                                                    </form>
                                                    -->
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="6">No Record Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </form>
                    {{ $solutionpending->appends($params)->links("pagination::bootstrap-4") }}
                </div>
            </div>
        </div>
        @include('partials/delete-confirm', ['title' => 'Solution Profile'])
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    <script type="text/javascript">
        var $j = jQuery.noConflict();
        var gettab = "{{$tab}}";
        $j('#show_btn').hide();
        $j(".deletesolutionbtn").click(function(){

        })
        $j("#deletebtn").click(function(){
            $j("#delete_multi").submit();
        })
        $j(document).ready(function(){
            var not_chk = $j('input.chkbox').not(':checked').length;
            $j('#chk_all').click(function() {

                $j('input:checkbox:not(:disabled)').prop("checked", $j(this).prop("checked"));
                check_checked();
            });
            function check_checked(){
                if ($j('input.chkbox').not(':checked').length == not_chk) {
                    $j('#show_btn').hide();
                } else {
                    $j('#show_btn').show();
                }
            }
            $j(".chkbox").click(function(){
                check_checked();
            })
            var gettab = "{{$input['tab'] ?? 'solutionprofile-tab' }}";
            if(gettab != ''){
                var tabval = gettab.replace('-tab','');
                $j(".nav-link").not($j("#"+gettab+"")).removeClass("active");
                $j(".tab-pane").not($j("#"+gettab+"")).removeClass("show active");
                //$j(".nav-link").($j("#"+gettab+"")).addClass("active");
                $j("#"+tabval+"").addClass("show active");
                $j("#"+gettab+"").addClass("active");
            } else {
                $j(".nav-link").not($j("#solutionprofile-tab")).removeClass("active");
                $j(".tab-pane").not($j("#solutionprofile")).removeClass("show active");
                //$j(".nav-link").($j("#"+gettab+"")).addClass("active");
                $j("#solutionprofile-tab").addClass("show active");
                $j("#solutionprofile").addClass("show active");
                //$j('[href="#datalist"]').tab('show');
            }
        });
        $j('#myTab a').on('click', function (e) {
            e.preventDefault()
            $j(this).tab('show');
            if($j(this).attr("id")=="solutionprofile-tab"){
                var link1 = "{{((isset($input['page']))?'&page='.$input['page']:'')}}";
                var links = link1.replace('&amp;','&');
                window.location = "{{url('solutionprofile')}}?tab=solutionprofile-tab";
            }
            if($j(this).attr("id")=="solutionpending-tab"){
                var link2 = "{{((isset($input['page']))?'&page='.$input['page']:'')}}";
                var links = link2.replace('&amp;','&');
                window.location = "{{url('solutionprofile')}}?tab=solutionpending-tab";
            }
        })
        var ck = CKEDITOR.replace('problem_solution');
    </script>
@endsection
