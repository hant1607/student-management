@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Result
                    <small>Add</small>
                </h1>
            </div>

            <!-- /.col-lg-12 -->
            <div class="col-lg-12" style="padding-bottom:120px">
                <div class="col-sm-5">
                    <label>Subject</label>
                </div>
                <div class="col-sm-5">
                    <label>Mark</label>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-success btnPlus" style="margin-bottom: 7%">+
                    </button>
                </div>
                <div style="display: none" id="count-subject">{{count($subjects)}}</div>

                {!! Form::open(['method'=>'POST', 'route'=>['results.storeResults', $id]]) !!}
                <div id="form-body" class="row">
                    @if(empty(old('subject_id')))
                        @foreach($results as $result)
                            <div class="field">
                                <div class="col-sm-5">
                                    <select class="form-group form-control" name="subject_id[]">
                                        @foreach($subjects as $subject)
                                            <option value="{{$subject->id}}" {{$subject->id == $result->subject_id ?'selected' : ''}}>{{$subject->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="mark[]" style="margin-bottom: 15px"
                                           value="{{$result->mark}}">
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-danger btnRemove">-</button>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @if(!empty(old('subject_id')))
                        @foreach(old('subject_id') as $key => $subjectID)
                            <div class="field">
                                <div>
                                    <div class="col-sm-5">
                                        <select class="form-group form-control" name="subject_id[]">
                                            <option value="">Please choose subject</option>
                                            @foreach($subjects as $subject)
                                                <option value="{{$subject->id}}" {{$subject->id == $subjectID ? 'selected' : ''}}>{{$subject->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="mark[]"
                                               value="{{old('mark')[$key]}}" style="margin-bottom: 15px">
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-danger btnRemove">-</button>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        {!! Form::submit('Add', ['class'=>'btn btn-success', 'id'=>'submit']) !!}
                        {!! Form::reset('Reset', ['class'=>'btn btn-default']) !!}
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
@section('script')
    <script>
        var totalSubject = $('#count-subject').html();
        var count = $('.field').length;
        $(document).ready(function () {
            var add = $('#fieldAdd').html();
            $('.btnPlus').on('click', function () {
                if (count <= totalSubject) {
                    $('#form-body').append(add);
                    count++;
                } else {
                    alert("This student already has enough subjects");
                }
            });
        });
        $(document).on('click', '.btnRemove', function () {
            $(this).parent().parent().remove();
            count--;

            var $select = $("select");
            var selected = [];
            $.each($select, function (index, select) {
                if (select.value !== "") {
                    selected.push(select.value);
                }
            });
            var del = $(this).parent().parent().find('select').val();
            selected.splice(selected.indexOf(del.toString()), 1);
            $("option").prop("disabled", false);
            for (var index in selected) {
                $('option[value="' + selected[index] + '"]').css("display", "none");
            }
        });
        $(document).on('click', 'select', function () {
            var $select = $("select");
            var selected = [];
            $.each($select, function (index, select) {
                if (select.value !== "") {
                    selected.push(select.value);
                }
            });
            $('select > option').not(this).css('display', 'block');
            $("option").prop("disabled", false);
            for (var index in selected) {
                $('option[value="' + selected[index] + '"]').css("display", "none");
            }
            $(this).parent().parent().find('td > i.remove-item').on('click', function () {
                var del = $(this).val();
                selected.splice(selected.indexOf(del.toString()), 1);
                for (var index in selected) {
                    $('option[value="' + selected[index] + '"]').css("display", "block");
                }
            });
        });
    </script>
@endsection

<div id="fieldAdd" class="field" style="display: none">
    <div>
        <div class="col-sm-5">
            <select class="form-group form-control" name="subject_id[]">
                <option value="">Please choose subject</option>
                @foreach($subjects as $subject)
                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="mark[]" value="" style="margin-bottom: 15px">
        </div>
        <div class="col-sm-2">
            <button type="button" class="btn btn-danger btnRemove">-</button>
        </div>
    </div>
</div>
