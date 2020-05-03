@extends('layouts.app')
@section('content')
    <section class="page-left-sidebar page-section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>{{trans('profile.document.title')}}</h2>
                        @if(Auth::user()->status == 'INACTIVE')
                        <h5 class="text-danger">Профиль будет доступ после модераций</h5>
                        @endif
                        <div class="separator"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="tabcontent accordion" style="">
                        <div class="accordion-title">
                            <a href="#" class="disabled">{{trans('profile.document.count')}}: {{count($documents)}}</a>
                        </div>
                        <div class="accordion-content" style="display: none;">
                            <div class="col-lg-12 col-md-12 ">
                                <div class="row">
                                    @if(count($documents) > 0)
                                        <div class="col-md-6"> <p class="text-dark">{{trans('profile.document.filename')}}</p></div>
                                        <div class="col-md-6"> <p class="text-dark">{{trans('profile.document.status')}}</p></div>
                                    @endif
                                    @foreach($documents as $document)
                                        <div class="col-md-6">
                                            <h6>{{$document->filename}}</h6>
                                        </div>
                                        <div class="col-md-6">
                                            @switch($document->status)
                                                @case('ACTIVE')
                                                <p class="text-success">{{trans('profile.document.active')}}</p>
                                                @break
                                                @case('INACTIVE')
                                                <p class="text-danger">{{trans('profile.document.inactive')}}</p>
                                                @break
                                                @case('REVIEW')
                                                <p class="text-dark">{{trans('profile.document.review')}}</p>
                                                @break
                                            @endswitch
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="document">{{ trans('profile.document.attach') }}</label>
                    <form method="post" action="{{route('profile-document-add')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row" id="add-file-block">
                            <div class="col-md-3">
                                <input id="document" name="files[]" class="form-control" type="file" multiple required>
                            </div>
                        </div>
                        <button type="submit" class="button red mt-3">{{trans('modal.send')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
