@extends('backend.layouts.app')
@section('title', __('labels.backend.tests.title').' | '.app_name())

@push('after-styles')
    <style>
        .select2-container--default .select2-selection--single {
            height: 35px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 35px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 35px;
        }

        #cke_text1 {
            height: 120px;
        }

        #cke_text2 {
            height: 120px;
        }

        #cke_1_bottom {
            display: none;
        }

        #cke_2_bottom {
            display: none;
        }

    </style>
@endpush
@section('content')
    
    <script src="https://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>

    {!! Form::open(['method' => 'POST', 'route' => ['admin.tests.store']]) !!}

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0">@lang('labels.backend.tests.create')</h3>
            <div class="float-right">
                <a href="{{ route('admin.tests.index') }}"
                   class="btn btn-success">@lang('labels.backend.tests.view')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('course_id', trans('labels.backend.tests.fields.course'), ['class' => 'control-label']) !!}
                    {!! Form::select('course_id', $courses, old('course_id'), ['class' => 'form-control select2']) !!}

                </div>

                <div class="col-12 col-lg-6  form-group">
                    {!! Form::label('title',trans('labels.backend.tests.fields.title'), ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.tests.fields.title')]) !!}

                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('description',trans('labels.backend.tests.fields.description'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control ', 'placeholder' => trans('labels.backend.tests.fields.description')]) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('text1', trans('labels.backend.tests.fields.text1'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('text1', old('text1'), ['class' => 'form-control ckeditor', 'placeholder' => '','name'=>'text1','id' => 'text1']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::label('text2', trans('labels.backend.tests.fields.text2'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('text2', old('text2'), ['class' => 'form-control ckeditor', 'placeholder' => '','name'=>'text2','id' => 'text2']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('color1',trans('labels.backend.tests.fields.color1'), ['class' => 'control-label']) !!}
                    {!! Form::color('color1', old('color1'), ['class' => 'form-control ']) !!}
                </div>
                <div class="col-12 col-lg-6 form-group">
                    {!! Form::label('color2',trans('labels.backend.tests.fields.color2'), ['class' => 'control-label']) !!}
                    {!! Form::color('color2', old('color2'), ['class' => 'form-control ']) !!}
                </div>
            </div>
{{--            <div class="row Secondary card bg-light">--}}
{{--                <div class="card-header">--}}
{{--                    <h5>Default Options</h5>--}}
{{--                </div>--}}
{{--                <div class="row card-body">--}}
{{--                    <div class="col-12 col-lg-4 form-group">--}}
{{--                        {!! Form::label('font', trans('labels.backend.tests.fields.default_font'), ['class' => 'control-label']) !!}--}}
{{--                        <select class="form-control" name="default_font">--}}
{{--                            @foreach($font_family as $fm)--}}
{{--                                <option value="{{$fm}}" style="font-family: {{$fm}}">{{$fm}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="col-12 col-lg-4 form-group">--}}
{{--                        {!! Form::label('size',trans('labels.backend.tests.fields.default_font_size'), ['class' => 'control-label']) !!}--}}
{{--                        <select class="form-control" name="default_font_size">--}}
{{--                            @foreach($font_size as $fs)--}}
{{--                                <option value={{$fs}} style="font-size: {{$fs}}px">{{$fs}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="col-12 col-lg-4 form-group">--}}
{{--                        {!! Form::label('color',trans('labels.backend.tests.fields.default_color'), ['class' => 'control-label']) !!}--}}
{{--                        {!! Form::color('default_font_color', old('default_font_color'), ['class' => 'form-control ']) !!}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="row">
                <div class="col-12 form-group">
                    {!! Form::hidden('published', 0) !!}
                    {!! Form::checkbox('published', 1, false, []) !!}
                    {!! Form::label('published', trans('labels.backend.tests.fields.published'), ['class' => 'control-label font-weight-bold']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

    <script>

        var editor_text1 = CKEDITOR.replace('text1', {
            height : 0,
            filebrowserUploadUrl: `{{route('admin.questions.editor_fileupload',['_token' => csrf_token() ])}}`,
            filebrowserUploadMethod: 'form',
            extraPlugins: 'font,colorbutton,colordialog,justify',
        });

        var callback_editor_text1 = function (event) {
            if (editor_text1.getSelection().getSelectedText().toString() == '') {
                var commandName = event.data.name;
                var selection = editor_text1.getSelection();
                var selectedElement = selection.getSelectedElement();
                if (!selectedElement)
                    selectedElement = new CKEDITOR.dom.element('p');
                selectedElement.setHtml("<p>Question Description</p>");
                editor_text1.insertElement(selectedElement);
                selection.selectElement(selectedElement);
            }
        }

        editor_text1.on('SelectionChange', callback_editor_text1);
        editor_text1.on('Change', callback_editor_text1);
        editor_text1.on('afterCommandExec', callback_editor_text1);

        var editor_text2 = CKEDITOR.replace('text2', {
            height : 150,
            filebrowserUploadUrl: `{{route('admin.questions.editor_fileupload',['_token' => csrf_token() ])}}`,
            filebrowserUploadMethod: 'form',
            extraPlugins: 'font,colorbutton,colordialog,justify',
        });

        var callback_editor_text2 = function(event) {
            if (editor_text2.getSelection().getSelectedText().toString() == '') {
                var commandName = event.data.name;
                var selection = editor_text2.getSelection();
                var selectedElement = selection.getSelectedElement();
                if (!selectedElement)
                    selectedElement = new CKEDITOR.dom.element('p');
                selectedElement.setHtml("<p>Question Help and Information</p>");
                editor_text2.insertElement(selectedElement);
                selection.selectElement(selectedElement);
            }
        }

        editor_text2.on('SelectionChange', callback_editor_text2);
        editor_text2.on('Change', callback_editor_text2);
        editor_text2.on('afterCommandExec', callback_editor_text2);

    </script>
@stop


