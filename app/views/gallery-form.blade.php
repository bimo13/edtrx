@extends('dashboard')

@section('title')
    Gallery
@stop

@section('styles')
    {{ HTML::style('assets/css/select2/select2.css') }}
    {{ HTML::style('assets/css/sa-datetimepicker/bootstrap-datetimepicker.min.css') }}
    {{ HTML::style('assets/css/custom/gallery-form.css') }}
@stop

@section('main-content')

    @if(isset($model))
        {{ Form::model($model, array('method' => 'PUT', 'id' => 'gallery-form', 'files' => true, 'route' => array('album.update', $model->id))) }}
    @else
        {{ Form::open(array('method' => 'POST', 'id' => 'gallery-form', 'route' => array('album.store'), 'files' => 'true', 'autocomplete' => 'off')) }}
    @endif


            {{ Form::hidden('teacher_id', Sentry::getUser()->id) }}
            <div class="col-sm-12">
                {{ Form::label('name', 'Album Name :') }}
                <div class="form-group gallery-form">
                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                    {{ $errors->first('name', '<div class="text-danger">:message</div>') }}
                </div>
            </div>

            <div class="col-sm-12">
                {{ Form::label('description', 'Description:') }}
                <div class="form-group gallery-form">
                    {{ Form::textarea('description', null, array('class' => 'form-control')) }}
                    {{ $errors->first('description', '<div class="text-danger">:message</div>') }}
                </div>
            </div>

            <div class="col-sm-12">
                {{ Form::label('venue', 'Venue :') }}
                <div class="form-group gallery-form">
                    {{ Form::text('venue', null, array('class' => 'form-control')) }}
                    {{ $errors->first('venue', '<div class="text-danger">:message</div>') }}
                </div>
            </div>

            <div class="col-sm-5">
                {{ Form::label('date', 'Date:') }}
                <div class="form-group gallery-form">
                    <div class='input-group date' id='agendaDate'>
                        {{ Form::text('date', null, array('class' => 'form-control', 'readonly')) }}
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    {{ $errors->first('date', '<div class="text-danger">:message</div>') }}
                </div>
            </div>

            <div class="col-sm-7">
                {{ Form::label('share_to', 'Sharing Option:') }}
                <div class="form-group gallery-form">
                    {{ Form::select('share_to[]', $parents, null, array('id' => 'share_to', 'class' => 'form-control', 'multiple' => 'multiple')) }}
                    {{ $errors->first('share_to', '<div class="text-danger">:message</div>') }}
                </div>
                <div class="text-info">*leave blank to set gallery as public</div>
            </div>

            <div class="col-sm-12">
                {{ Form::label('images', 'Add Photos:') }}
                <div class="form-group">
                    <div class="add-photos"><i class="fa fa-2x fa-cloud-upload"></i></div>
                    {{ Form::file('images[]', array('class' => 'image-input')) }}
                    {{ $errors->first('images', '<div class="text-danger">:message</div>') }}
                </div>
            </div>

            <div class="col-lg-12 mg-top-35px">
                <div class="form-group text-right">
                    {{ Form::submit('Create Album', array('class' => 'btn roundless btn-edutrax-cyan')) }}
                    <a href="javascript:void(0);" class="btn roundless btn-edutrax-grey">Cancel</a>
                </div>
            </div>

    <!-- conditional-lines indent -->
        {{ Form::close() }}
    <!-- conditional-lines indent -->

@stop

@section('scripts')
    <!-- JQuery Bootstrap.Filestyle -->
    {{ HTML::script('assets/js/forms.filestyle.js') }}
    {{ HTML::script('assets/js/select2.js') }}
    {{ HTML::script('assets/js/multifile/jquery.MultiFile.js') }}
    <script type="text/javascript">
        $("#share_to").select2();
        $(".image-input").MultiFile({
            accept: 'jpg|png|gif',
            preview: true,
            previewCss: 'border: solid 1px #C1C1C1; width: 100%; padding-bottom: 100%; background-size: cover;'
        });
    </script>
@stop