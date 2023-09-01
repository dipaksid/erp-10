@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Customer Service</h1>
        </div>

        <div>

            @include('partials/messages')

            <form id="groupform" method="post" action="{{ url('customer-groups') }}" >

                @csrf

                <div class="row form-group">
                    <div class="col-3">
                        <label for="companycode">Customer Code:</label>
                        <input type="text" seq="1" class="form-control enterseq" id="companycode" name="companycode" maxlength="30"/>
                        <span class="text-danger">{{ $errors->first('companycode') }}</span>
                    </div>
                    <div class="col-6">
                        <label for="companyname">Customer Name</label>
                        <input type="text" class="form-control" id="companyname" name="companyname" readOnly="readOnly" maxlength="200"/>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-9">
                        <table class="table" id="tblcust">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th style="width:80px;">Category</th>
                                <th style="width:90px;">Amount </th>
                                <th style="width:110px;">Period Type</th>
                                <th>Include <br>Hardware<br>[Y/N]</th>
                                <th style="width:80px;">Pay <br>Before <br>Service<br>[Y/N]</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Service<br>Pay Date</th>
                                <th>Software<br>License<br> Per PC</th>
                                <th>POS<br>License<br> Per PC</th>
                                <th>VPN Address </th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="empty">
                                <td class="text-center" colspan="11">No Record Found</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <a href="{{ action('App\Http\Controllers\CustomerServicesController@index') }}" class="btn btn-secondary btn-xs">Back</a>
                <button type="submit" seq="4" class="btn btn-primary enterseq">Create</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-autocomplete.min.js') }}"></script>
    <script type="text/javascript">
        if ($("#groupform").length > 0) {
            $("#groupform").validate({
                rules: {
                    groupcode: {
                        required: true,
                        maxlength: 20
                    },
                    description: {
                        required: true,
                        maxlength:200
                    }
                },
                messages: {
                    groupcode: {
                        required: "Please enter group code",
                        maxlength: "Your group code maxlength should be 10 characters long."
                    },
                    description: {
                        required: "Please enter description",
                        maxlength: "The description should be 60 characters long"
                    }
                },
            })
            $("#groupform").submit(function(evt){
                $("input[type='text']").each(function(i){
                    $(this).val($(this).val().toUpperCase());
                })
            })
        }
        $(document).ready(function(evt){
            $(".enterseq").each(function(i){
                $(this).keydown(function(event){
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    switch(keycode) {
                        case 13:
                            if($(this).is("input")) {
                                $(this).val($(this).val().toUpperCase());
                            } else if($(this).is("button[type='submit']")) {
                                $(this).click();
                                return false;
                            }
                            if($(this).attr("name")=="description"){
                                $(".customerAutoSelect").select();
                            } else {
                                var dd = parseInt($(this).attr("seq"),10)+1;
                                if( $(".enterseq").filter("[seq='"+dd+"']").length>0){
                                    if($(".enterseq").filter("[seq='"+dd+"']").is("input")) {
                                        $("input[type='text']").filter("[seq='"+dd+"']").select();
                                    } else if($(".enterseq").filter("[seq='"+dd+"']").is("select")){
                                        $("select").filter("[seq='"+dd+"']").focus();
                                    } else if($(".enterseq").filter("[seq='"+dd+"']").is("checkbox")){
                                        $("checkbox").filter("[seq='"+dd+"']").select();
                                    } else if($(".enterseq").filter("[seq='"+dd+"']").is("button")){
                                        $("button").filter("[seq='"+dd+"']").focus();
                                    }
                                }
                            }
                            break;
                        case 38:
                            var dd = (parseInt($(this).attr("seq"),10)>0)?(parseInt($(this).attr("seq"),10)-1):parseInt($(this).attr("seq"),10);
                            if($("input[type='text']").filter("[seq='"+dd+"']").length>0){
                                $("input[type='text']").filter("[seq='"+dd+"']").select();;
                            } else if($("select").filter("[seq='"+dd+"']").length>0){
                                $("select").filter("[seq='"+dd+"']").focus();;
                            }
                    }
                    if(keycode==13)
                        return false;
                })
            })
            if($(".enterseq").filter("[seq='1']").is("input")) {
                $("input[type='text']").filter("[seq='1']").select();
            } else if($(".enterseq").filter("[seq='1']").is("select")){
                $("select").filter("[seq='1']").focus();
            } else if($(".enterseq").filter("[seq='1']").is("checkbox")){
                $("checkbox").filter("[seq='1']").select();
            } else if($(".enterseq").filter("[seq='1']").is("button")){
                $("button").filter("[seq='1']").focus();
            }

            $('.customerAutoSelect').autoComplete({minLength:2,
                events: {
                    searchPost: function (resultFromServer) {
                        setTimeout(function(){
                            $('.customerAutoSelect').next().find('a').eq(0).addClass("active");
                        },100)
                        return resultFromServer;
                    }
                }
            });
            $('.customerAutoSelect').keydown(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode==13){
                    if($(this).val()==""){
                        setTimeout(function(){
                            $("button").filter("[seq='4']").focus();
                        },500);
                    }
                    return false;
                }
            })
            $('.customerAutoSelect').on('change', function (e, datum) {
                setTimeout(function(){
                    js_add_customer($("input[name='customerid']").val(),$('.customerAutoSelect').val());
                    $('.customerAutoSelect').select();
                },300);
                return false;
            });
            $('.customerAutoSelect').on('autocomplete.select', function (e, datum) {
                $(this).change();
                return false;
            })
        })
        function js_add_customer(id,name){
            if(name!="" && id!=""){
                if( $("table#tblcust tbody tr.empty").length>0){
                    $("table#tblcust tbody tr.empty").remove();
                }
                var bcheck=false;
                $("input[name='cust[]']").each(function(i){
                    if($(this).val()==id){
                        bcheck=true;
                    }
                })
                if(!bcheck) {
                    var ncount=$("table#tblcust tbody tr").length;
                    var trrow="<tr>";
                    trrow+="<td scope=\"row\"><input type='hidden' name='cust[]' value='"+id+"'><span>"+(ncount+1)+"</span></td>";
                    trrow+="<td>"+name+"</td>";
                    trrow+="<td class=\"text-center col-2\">";
                    trrow+="<button class=\"btn btn-danger\" type=\"button\" onclick=\"js_delete(this);\">Delete</button>";
                    trrow+="</td>";
                    trrow+="</tr>";
                    $("table#tblcust tbody").append(trrow);
                    $(".customerAutoSelect").select();
                }
                $(".customerAutoSelect").val('');
                $("input[name='customerid']").val('');
            } else {
                $("button").filter("[seq='4']").focus();
            }
            return false;
        }
        function js_delete(obj){
            $(obj).parent().parent().remove();
            if($("table#tblcust tbody tr").length>0){
                $("table#tblcust tbody tr").each(function(i){
                    $(this).find("td").eq(0).find('span').html((i+1));
                })
            } else {
                var trrow = "<tr class=\"empty\">";
                trrow += "<td class=\"text-center\" colspan=\"3\">No Record Found</td>";
                trrow += "</tr>";
                $("table#tblcust tbody").append(trrow);
            }
            return false;
        }
    </script>
@endsection
